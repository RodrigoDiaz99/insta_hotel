@extends('layouts.app')

@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">HABITACIONES</h3>

                <a href="{{ route('room.create', $establishment_id) }}"
                    class="btn btn-icon btn-success d-flex align-items-center">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="btn-inner--text">Agregar Habitación</span>
                </a>
            </div>
        </header>
        <div class="card px-2 py-4 ">
            <div class="row mb-4">
                @forelse ($rooms as $room)
                    <div class="col-sm-3">
                        <div class="card">

                            @if ($room->status == 1)
                                <div id="card-header" class="card-header-{{ $room->id }} p-0 bg-success text-white">
                                @elseif ($room->status == 2)
                                    <div id="card-header" class="card-header-{{ $room->id }} p-0 bg-danger text-white">
                                    @elseif($room->status == 3)
                                        <div id="card-header"
                                            class="card-header-{{ $room->id }} p-0 bg-primary text-white">
                                        @elseif ($room->status == 4)
                                            <div id="card-header"
                                                class="card-header-{{ $room->id }} p-0 bg-darker text-white">
                            @endif

                            <span class="card-title text-center   my-1 font-weight-bold d-block">
                                {{ $room->name }}
                            </span>
                        </div>

                        <div class="card-body pt-2">
                            <div class="col">

                                <span class="text-xs font-weight-bold my-2">
                                    <strong>Capcidad: </strong><span>{{ $room->room_capacity }} Personas</span>
                                </span>
                            </div>

                            <div class="col">
                                @if ($room->status == 1)
                                    <span class="status-{{ $room->id }} text-xs font-weight-bold my-2">
                                        Disponible desde:
                                    </span>
                                @elseif ($room->status == 2)
                                    <span class="status-{{ $room->id }} text-xs font-weight-bold my-2">
                                        Ocupado desde: </span>
                                @elseif($room->status == 3)
                                    <span class="status-{{ $room->id }} text-xs font-weight-bold my-2">
                                        Checking-out desde </span>
                                @elseif ($room->status == 4)
                                    <span class="status-{{ $room->id }} text-xs font-weight-bold my-2">
                                        Deshabilitado desde </span>
                                @endif
                                <br>
                                <span class="ocupado-{{ $room->id }}"> {{ $room->updated_at }}
                                </span> </span>
                            </div>



                        </div>

                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                <button data-room_id="{{ $room->id }}" class="changeStatusButton btn btn-primary"
                                    type="button" data-toggle="modal" data-target="#changeStatus">Estado</button>
                                <a href="{{ route('reservaciones.create', ['room_id' => $room->id]) }}"
                                    class="btn btn-success">Reservar</a>

                            </div>
                            <div class="d-flex justify-content-center">

                                <a title="Editar Habitacion" type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editRoom-{{ $room->id }}">Editar</a>
                                @include('rooms.edit')
                                <form action="{{ route('room.delete', $room->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>

                                </form>

                            </div>
                        </div>

                    </div>
            </div>
        @empty
            <div class="text-center mt-3">
                <strong class="h4 text-danger">NO HAY HABITACIONES PARA MOSTRAR</strong>
            </div>
            @endforelse
        </div>

        @include('rooms.status.changeStatus')
    @endsection

    @section('scripts')
        <script>
            $(function() {
                var room_id = 0;
                var selected_card = null;
                $('.changeStatusButton').on('click keyup', function() {
                    room_id = $(this).data('room_id')
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })


                $('#cambiar').on('click', function() {
                    $.ajax({
                        url: "{{ route('room.status') }}",
                        method: 'post',
                        data: {
                            room_id: room_id,
                            status: $('#status').val()

                        },
                        success: function(response) {
                            $('#changeStatus').modal('hide');
                            swal_success(response.message);
                            $('.card-header-' + room_id + '').alterClass('bg-*', response.color)
                            $('.ocupado-' + room_id + '').text(response.updated_at)
                            $('.status-' + room_id + '').text(response.status)

                        },

                        error: function(response) {
                            if (response.status != 422) {
                                swal_error('Ha ocurrido un error inesperado.');
                            }
                            validate(response);
                        }

                    })

                })
            })
        </script>
    @endsection
