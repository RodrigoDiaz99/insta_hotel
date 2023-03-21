@extends('layouts.guest')

@section('content')
    <div class="container-fluid">
    {{--     <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">Establecimientos</h3>
             </div>
        </header> --}}

        <div class="card px-2 py-4">
            <div class="mb-4">

                <div class="row gx-2 gy-4">
                    @forelse ($establishments as $row)
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header p-0 mx-3 mt-3">
                                    <span class="card-title h2 d-block text-darker">
                                        {{ $row->name }}
                                    </span>
                                    <img src="{{ asset('images\placeholder-establecimiento.jpg') }}" class="img-fluid border-radius-lg">
                                </div>

                                <div class="card-body">
                                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                        <strong>Dirección: </strong><span>{{ $row->location }}</span>
                                    </span>


                                    <p class="card-description mb-4">
                                        <strong>Descripción: </strong>
                                        {{ $row->description }}
                                    </p>

                                    <section class="row">
                                        <div class="col">
                                            <a href="{{ route('habitaciones', $row->id) }}" class="btn btn-block btn-success">
                                                Seleccionar
                                            </a>
                                        </div>

                                    </section>


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
