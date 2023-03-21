@extends('layouts.app')
@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')
    <div class="container-fluid">
        <header class="card px-2 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2">Editar datos del cliente</h3>
            </div>
        </header>

        <div class="card px-2 mt-4 py-4">
            <div class="row gx-2 gy-4">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <form action="{{ route('clientes.update',$cliente->id)}}" method="POST">
                                        @csrf
                                        {{method_field('PUT')}}
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="nombre">Nombre <small style="color:red;">*</small></label>
                                                <input type="text" name="nombre" id="nombre" class="form-control" autocomplete="off"
                                                value="{{$cliente->nombre}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="apellido_p">Apellido paterno <small style="color:red;">*</small></label>
                                                <input type="text" name="apellido_p" id="apellido_p" class="form-control"autocomplete="off"
                                                value="{{$cliente->apellido_p}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="apellido_m">Apellido materno <small style="color:red;"></small></label>
                                                <input type="text" name="apellido_m" id="apellido_m" class="form-control" autocomplete="off"
                                                value="{{$cliente->apellido_m}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="fecha_n">fecha de nacimiento</label>
                                                <input type="date" name="fecha_n" id="fecha_n" class="form-control" autocomplete="off"
                                                value="{{$cliente->fecha_n}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="genero">Sexo</label>
                                                <input type="text" name="genero" id="genero" class="form-control" autocomplete="off"
                                                value="{{$cliente->genero}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="origen">Origen</label>
                                                <input type="text" name="origen" id="origen" class="form-control" autocomplete="off"
                                                value="{{$cliente->origen}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="tipo_documento">Tipo de documento <small style="color:red;">*</small></label>
                                                <select name="tipo_documento" id="tipo_documento" class="form-control">
                                                    <option value="">Seleccione documento</option>
                                                    <option value="DNI" {{$cliente->tipo_documento == 'DNI' ? 'selected' : '' }}>DNI</option>
                                                    <option value="Carnet de conducir" {{$cliente->tipo_documento == 'Carnet de conducir' ? 'selected' : ''}}>Carnet de conducir</option>
                                                    <option value="Pasaporte" {{$cliente->tipo_documento == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                                    <option value="Sin_documento" {{$cliente->tipo_documento == 'Sin_documento' ? 'selected' : '' }}>Sin_documento</option>
                                                    <option value="Otro" {{$cliente->tipo_documento == 'Otro' ? 'selected' : '' }}>Otro</option>
                                                    <option value="Per. residencia esp." {{$cliente->tipo_documento == 'Per. residencia esp.' ? 'selected' : '' }}>Per. residencia esp.</option>
                                                    <option value="Permiso UE" {{$cliente->tipo_documento == 'Permiso UE' ? 'selected' : '' }}>Permiso UE</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="documento">Documento<small style="color:red;">*</small></label>
                                                <input type="text" name="documento" id="documento" class="form-control" autocomplete="off"
                                                value="{{$cliente->documento}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="expedicion">Expedición</label>
                                                <input type="date" name="expedicion" id="expedicion" class="form-control" autocomplete="off"
                                                value="{{$cliente->expedicion}}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="pais_documento">Pais documento</label>
                                                <input type="text" name="pais_documento" id="pais_documento" class="form-control" autocomplete="off"
                                                value="{{$cliente->pais_documento}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="email">Correo electrónico</label>
                                                <input type="text" name="email" id="email" class="form-control"
                                                value="{{$cliente->email}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control"
                                                value="{{$cliente->direccion}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="codigo_postal">Codigo postal</label>
                                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control"
                                                value="{{$cliente->codigo_postal}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="poblacion">Poblacion</label>
                                                <input type="text" name="poblacion" id="poblacion" class="form-control"
                                                value="{{$cliente->poblacion}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="provincia">Provincia</label>
                                                <input type="text" name="provincia" id="provincia" class="form-control"
                                                value="{{$cliente->provincia}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="telefono_1">Telfono 1</label>
                                                <input type="text" name="telefono_1" id="telefono_1" class="form-control"
                                                value="{{$cliente->telefono_1}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telefono_2">Telefono 2</label>
                                                <input type="text" name="telefono_2" id="telefono_2" class="form-control"
                                                value="{{$cliente->telefono_2}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="observaciones">Observaciones</label>
                                                <input type="text" name="observaciones" id="observaciones" class="form-control"
                                                value="{{$cliente->observaciones}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection