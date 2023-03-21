@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">Tipos de habitación</h3>
                <button type="button" class="btn btn-icon btn-success d-flex align-items-center" data-toggle="modal" data-target="#createRoomArea">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <span class="btn-inner--text">Agregar tipo de habitación</span>
                </button>
            </div>
        </header>
        <div class="card px-2 pt-4 mb-3">
            <div class="mb-4">
                <div wire:loading.remove wire:target='search' class="row gx-2 gy-4">
                    <div class="table-responsive">
                        @if (isset($tipos) != null)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th class=" text-xxs font-weight-bolder opacity-7">
                                            Nombre</th>
                                        <th class="  text-xxs font-weight-bolder opacity-7 ps-2">
                                            Fecha de creación</th>
                                        <th class="opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($tipos as $row)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-xs">{{ $row->name }}</h6>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $row->created_at->toDateString() }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <button data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-target="#editTipo" data-toggle="modal"
                                                    class="edit btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button data-id="{{ $row->id }}" class="delete btn btn-sm btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center mt-3">
                                <strong class="h4 text-danger">NO HAY TIPOS DE HABITACIÓN PARA MOSTRAR</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('rooms.types.create')
    @include('rooms.types.edit')

@endsection

@section('scripts')
    <script>
        $('.edit').on('click', function() {

            $('#edit_id').val($(this).data('id'))
            $('#edit_name').val($(this).data('name'))
        })

        $.ajaxSetup({
            headers: {
                "X-CSRF-Token": $("meta[name=csrf-token]").attr("content")
            },
        });

        $('.delete').on('click', function() {

            $.ajax({
                type: 'POST',
                data: {
                    type_id: $(this).data('id')
                },
                url: "{{ route('tiposhabitacion.delete') }}",
                success: function(response) {
                    window.location.reload();
                }
            })
        })
    </script>
@endsection
