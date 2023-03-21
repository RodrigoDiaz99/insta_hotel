@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('establishments.index') }}" class="btn btn-icon btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </a>

                <h3 class="h2 me-3">Agregar Establecimiento</h3>
            </div>
        </header>


        <div class="card py-3">
            <div class="border-bottom px-3">
                <h5 class="h5 mb-2">Datos Generales del Establecimiento</h5>
            </div>



            <form action="{{ route('establishments.store') }}" method="POST" class="form px-3">
                @csrf
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Nombre Establecimiento</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" name='name' placeholder="Nombre" type="text">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Dirección Establecimiento</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('establishment.location') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" name="location" placeholder="Dirección" type="text">
                                </div>
                                @error('establishment.location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Capacidad Establecimiento</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('establishment.capacity') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control " placeholder="Capacidad" name="capacity" type="number">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Tipo Establecimiento</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('establishment.type') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <select class="form-control" name ="establishment_types_id">
                                        <option value="" selected>SELECCIONE TIPO</option>
                                        @foreach ($establishment_type as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('establishment.type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="">Dueño Establecimiento</label>
                            <div class="form-group">
                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text @error('establishment.owner') border border-danger text-danger @enderror"><i
                                                class="ni ni-zoom-split-in"></i></span>
                                        <select name="owner" class="form-control" name="owner">
                                            <option value="" selected>SELECCIONE TIPO</option>
                                            @foreach ($user as $owner)
                                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('establishment.owner')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="">Shelly (auth_key)</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('establishment.shellyAuthKey') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control @error('establishment.shellyAuthKey') is-invalid @enderror" placeholder="Capacidad" type="text">
                                </div>
                                <small class="text-primary">* Este campo puede quedar vacio.</small><br>
                                @error('establishment.shellyAuthKey')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label>Areas del Establecimiento</label>
                                <button type="button" data-toggle="modal" data-target="#addEstablishmentAreas" class="btn btn-sm btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-plus-circle"
                                        viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="form-group">
                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text @error('establishment.areas') border border-danger text-danger @enderror"><i
                                                class="ni ni-zoom-split-in"></i></span>
                                        <select multiple class="form-control @error('establishment.areas') is-invalid @enderror">
                                            @foreach ($establishment_area as $areas)
                                                <option value="{{ $areas->id }}">{{ $areas->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('establishment.areas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label>Descripción</label>
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text @error('establishment.description') border border-danger text-danger @enderror"><i
                                        class="ni ni-zoom-split-in"></i></span>
                                <textarea style="resize: none" class="form-control @error('establishment.description') is-invalid @enderror" placeholder="Capacidad"></textarea>
                            </div>
                            <small class="text-primary">* Este campo puede quedar vacio.</small><br>
                            @error('establishment.description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer mb-5">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('establishments.index') }}"
                                class="btn btn-block btn-danger d-flex justify-content-center  align-items-center mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1"
                                    viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                <span class="btn-inner--text">Cancelar</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-success d-flex justify-content-center  align-items-center mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1"
                                    viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                <span class="btn-inner--text">Guardar Establecimiento</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
