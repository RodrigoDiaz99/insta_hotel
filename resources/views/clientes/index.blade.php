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
                <h3 class="h2">Clientes</h3>

                <a href="{{ route('clientes.create') }}" class="btn btn-icon btn-success d-flex align-items-center">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="btn-inner--text">Agregar Cliente</span>
                </a>

                <a href="{{ route('incidentes.index') }}" class="btn btn-icon btn-danger d-flex align-items-center">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="btn-inner--text">Gestion de incidencias</span>
                </a>
                
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5">Administra los Clientes.</h3>
            </div>
        </header>

        <div class="card px-2 mt-4 py-4">
            <div class="row gx-2 gy-4">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{route('clientes.index')}}" method="get">
                                <div class="form-row">
                                    <div class="col-sm-4 my-2">
                                        <input type="text" class="form-control" name="texto" value="{{$texto}}">
                                    </div>
                                    <div class="col-auto my-2">
                                        <input type="submit" class="btn btn-primary" value="buscar">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellido Paterno</th>
                                                    <th>Apellido materno</th>
                                                    <th>Opciones</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($cliente)<=0)
                                                    <tr>
                                                        <td colspan="8">No hay resultados</td>
                                                    </tr>
                                                @else
                                                @foreach ($cliente as $clientes)
                                                    @if($clientes->estado === 'activo')
                                                    <tr>
                                                        <td>
                                                            <h6 class="text-sm">{{ $clientes->nombre }}</h6>
                                                        </td>

                                                        <td>
                                                            <h6 class="text-sm">{{ $clientes->apellido_p }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm">{{ $clientes->apellido_m }}</h6>
                                                        </td>

                                                        <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#info_cliente-{{$clientes->id}}">
                                                                        <i class="fa-solid fa-book-user"></i>Info
                                                                    </button>
                                                                    @include('clientes.extras.info_cliente')
                                                                    <a href="{{ route('clientes.edit',$clientes->id)}}" class="btn btn-icon btn-success d-flex align-items-center">
                                                                        <i class="fa-solid fa-user-pen"></i>
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$clientes->id}}">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                    @include('clientes.extras.delete')
                                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#incidente-{{$clientes->id}}">
                                                                        <i class="fa-solid fa-triangle-exclamation"></i> Reportar incidente
                                                                    </button>
                                                                    @include('incidentes.extras.create')
                                                                </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        {{$cliente->links()}}
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