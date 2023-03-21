@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('establishments.rooms.index', $establishment) }}" class="btn btn-icon btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </a>
                <h3 class="h2 me-3">Agregar Habitaciones</h3>
            </div>
        </header>

        <div class="card py-3">
            <div class="border-bottom px-3">
                <h5 class="h5 mb-2">Datos de la Habitación</h5>
            </div>

            <form action="{{ route('room.store', $establishment->id) }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Nombre" type="text" name="name">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Descripción</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Descripcion" type="text" name="description">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Precio Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" type="number" name="precio">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Capacidad Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text  "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control  " placeholder="Capacidad" name="capacidad" type="number">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <label>Tipo Habitación</label>

                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('room.type') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <select class="form-control" name="room_type">
                                        <option value="">SELECCIONE</option>
                                        @foreach ($establishment->room_type as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                       {{--  <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <label>Areas Habitación</label>
                                <button type="button" data-toggle="modal" data-target="#addRoomAreas" class="btn btn-sm btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-plus-circle"
                                        viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group  ">
                                    <div class="form-control  " style=" overflow:auto; height:94px">
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                    </div>

                </div>

                <div class="card-footer mb-5">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('establishments.rooms.index', $establishment) }}" wire:offline.attr="disabled"
                                class="btn btn-block btn-danger d-flex justify-content-center  align-items-center mt-4">
                               
                                <span class="btn-inner--text">Cancelar</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" wire:offline.attr="disabled"
                                class="btn btn-block btn-success d-flex justify-content-center  align-items-center mt-4">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <span class="btn-inner--text">Guardar Establecimiento</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
