{{--Comentario de prueba discord 2 --}}
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
                <h3 class="h2">Inventario</h3>

                <a href="{{ route('establishments.create') }}" class="btn btn-icon btn-success d-flex align-items-center"
                    data-toggle="modal" data-target="#addInventario">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text">Agregar Inventario</span>
                </a>
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
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Cantidad</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Precio de Compra</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Precio de Venta</th>
                                                        <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Producto</th>

                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inventario as $row)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">

                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $row->quantity }}</h6>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $row->purchase_price }}</p>

                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="badge badge-sm bg-gradient-success">{{ $row->sale_price }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <span
                                                                class="badge badge-sm bg-gradient-success">{{ $row->product->first()->name }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="{{ route('establishments.create') }}"
                                                                        class="btn btn-icon btn-success"
                                                                        data-toggle="modal"
                                                                        data-target="#editar-{{ $row->id }}"
                                                                        title="Editar Inventario"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    @include('inventario.extras.modals.editInventario')
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <form action="{{ route('inventory.delete', $row->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-icon btn-success"><i
                                                                                class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>




                                                            </div>

                                                        </td>


                                                    </tr>
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
    @include('inventario.extras.modals.createInventary')
 @include('inventario.extras.modals.Edit')

@endsection


@section('scripts')
    <script>
        let ruta_index = "{{ route('inventory.index') }}"
        let ruta_inventario = "{{ route('inventory.store') }}"
        let table_inventario = "{{ route('inventory.getInventario') }}"
    </script>
    <script src="{{ asset('js/inventario/inventario.js') }}"></script>
@endsection
