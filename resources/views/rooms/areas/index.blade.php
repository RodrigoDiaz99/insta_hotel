@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">Áreas de Habitaciones</h3>
                <button type="button" class="btn btn-icon btn-success d-flex align-items-center" data-toggle="modal"
                    data-target="#createRoomArea">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text">Agregar Área de Habitaciones</span>
                </button>
            </div>
        </header>
        <div class="card px-2 pt-4 mb-3">
            <div class="mb-4">
                <div wire:loading.remove wire:target='search' class="row gx-2 gy-4">
                    <div class="table-responsive">
                        @if (isset($areas) != null)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOMBRE</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            FECHA CREACION</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($areas as $row)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-xs">{{ $row->name }}</h6>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $row->created_at->toDateString() }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a title="Editar Habitacion" class="btn btn-sm btn-warning" type="button"
                                                    data-toggle="modal" data-target="#editarea-{{ $row->id }}"> <i
                                                        class="fas fa-edit"></i></a>
                                                @include('rooms.areas.extras.area_modales.edit')
                                                <form action="{{ route('room_area.delete', $row->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                <button class="btn btn-sm btn-danger"  title="Eliminar Tramo" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center mt-5">
                            </div>
                            <div class="text-center mt-3">
                                <strong class="h4 text-danger">NO HAY AREA DE HABITACIONES PARA MOSTRAR</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rooms.areas.create')
@endsection
