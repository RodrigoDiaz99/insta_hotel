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
                <h3 class="h2">Departamento</h3>

                <a href="#" class="btn btn-icon btn-success d-flex align-items-center" data-toggle="modal" data-target="#addTramo" id="modalCreateComanda">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text">Agregar Departamento</span>
                </a>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5">Administra los departamentos.</h3>
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
                                                    <th>Nombre</th>

                                                    <th>Descripcion</th>
                                                    <th>Fecha Creacion</th>
                                                    <th>Fecha Modificacion</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($departamento as $row)
                                                    <tr>
                                                        <td >
                                                            <h6 class="text-sm">{{ $row->nombre}}</h6>
                                                        </td>

                                                        <td>
                                                            <h6 class="text-sm" >{{ $row->descripcion }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm" >{{ $row->created_at }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm" >{{ $row->updated_at }}</h6>
                                                        </td>

                                                        <td >
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a title="Editar Departamento" type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#editDepartamento-{{$row->id}}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                </div>

                                                                <div class="col-md-6">
                                                                    <form action="{{route('departamento.delete',$row->id)}}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-icon btn-success" title="Eliminar Departamento"><i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @include('departamento.extras.modals.editDepartamento')
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

    @include('departamento.extras.modals.createDepartamento')


@endsection


@section('scripts')
   <script src="{{asset('js/comanda/comanda.js')}}">

   </script>
@endsection
