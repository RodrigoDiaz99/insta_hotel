@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">Establecimientos</h3>

                <a href="{{ route('establishments.create') }}" class="btn btn-icon btn-success d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text">Agregar Establecimiento</span>
                </a>
            </div>
        </header>


        <div class="card px-2 py-4">
            <div class="mb-4">

                <div class="row gx-2 gy-4">
                    @forelse ($establishments as $row)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header p-0 mx-3 mt-3">
                                    <img src="https://tse4.mm.bing.net/th?id=OIP.P9sPif1ry77tJOTBKFfp1wHaFK&pid=Api" class="img-fluid border-radius-lg">
                                </div>

                                <div class="card-body pt-2">
                                    <span class="card-title h5 d-block text-darker">
                                        {{ $row->name }}
                                    </span>

                                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                        <strong>Dirección: </strong><span>{{ $row->location }}</span>
                                    </span>

                                    <br>

                                    <span class="text-xs font-weight-bold my-2">
                                        <strong>Capcidad: </strong><span>{{ $row->capacity }} Personas</span>
                                    </span>

                                    <br>

                                    <span class="text-xs font-weight-bold my-2">
                                        <strong>Areas: </strong><span></span>
                                    </span>

                                    <p class="card-description mb-4">
                                        <strong>Descripción: </strong>
                                        {{ $row->description }}
                                    </p>

                                    <section class="row">
                                        <div class="col">
                                            <a href="{{ route('establishments.edit', $row->id) }}" class="btn btn-block btn-warning">
                                                <i class="fas fa-edit    "></i>
                                            </a>
                                        </div>
                                        {{-- <div class="col">
                                            <button class="btn btn-block btn-danger" wire:click='deleteEstablishment({{ $row->id }})'>
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div> --}}
                                    </section>

                                    <div class="author align-items-center">

                                        <div class="name ps-3">
                                            <span>{{ $row->Owner->name }}</span>
                                            <div class="stats">
                                                <small>{{ $row->created_at->toDateString() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center mt-5">

                        </div>
                        <div class="text-center mt-3">
                            <strong class="h4 text-danger">NO HAY ESTABLECIMIENTOS PARA MOSTRAR</strong>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <script></script>
    </div>
@endsection
