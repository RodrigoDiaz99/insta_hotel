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
                <h3 class="h2">Incidentes</h3>
                
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5">Administra incidentes de clientes.</h3>
            </div>
        </header>

        <div class="card px-2 mt-4 py-4">
            <div class="row gx-2 gy-4">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre completo</th>
                                                    <th>Documento</th>
                                                    <th>Descripcion <br> del incidente</th>
                                                    <th>Nivel de<br>incidencia</th>
                                                    <th>Lugar del <br> incidente</th>
                                                    <th>Compartir <br> con:</th>
                                                    <th>Opciones</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($incidentes as $incidente)
                                                    @if($incidente->estado === 'activo')
                                                        @if( ((auth()->user()->id == $incidente->vsuites)||(auth()->user()->id == $incidente->user_id)) || ((auth()->user()->id == $incidente->lavanda)||(auth()->user()->id == $incidente->user_id)) )
                                                            <tr>
                                                                <td>
                                                                    <h6 class="text-sm">{{$incidente->cliente->nombre}} <br> {{$incidente->cliente->apellido_p}} {{$incidente->cliente->apellido_m}}</h6>
                                                                </td>

                                                                <td>
                                                                    <h6 class="text-sm">{{$incidente->cliente->documento}}</h6>
                                                                </td>

                                                                <td>
                                                                    <h6 class="text-sm">{{ $incidente->mensaje }}</h6>
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-sm">{{ $incidente->nivel }}</h6>
                                                                </td>

                                                                <td>
                                                                    <h6 class="text-sm">{{ $incidente->lugar }}</h6>
                                                                </td>

                                                                <td>
                                                                    @if($incidente->vsuites == "1")
                                                                        <h6>VSUITES</h6><br>
                                                                    @endif()
                                                                    @if($incidente->lavanda == "2")
                                                                        <h6>LAVANDA</h6>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                        @if(auth()->user()->id == $incidente->user_id)
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-{{$incidente->id}}">
                                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                            </button>
                                                                            @include('incidentes.extras.edit')
                                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$incidente->id}}">
                                                                                <i class="fa-solid fa-trash"></i>
                                                                            </button>
                                                                            @include('incidentes.extras.delete')
                                                                        </div>
                                                                        @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
@endsection