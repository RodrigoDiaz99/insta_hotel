@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card px-2 py-4 mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h2 ms-3">Reservaciones</h3>
                {{-- <a href="{{ route('reservaciones.create') }}" class="btn btn-icon btn-success d-flex align-items-center">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i><span class="btn-inner--text">Hacer una reservación</span>
                </a> --}}
            </div>
        </header>

        <div class="card">
            <div class="card-body">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Código</th>
                            <th>Habitación</th>
                            <th>Cliente</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Cancelación</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservaciones as $reservacion)
                            @if ($reservacion->cancelado == 1)
                                <tr class="bg-danger">
                                @else
                                <tr>
                            @endif
                            <td>
                                <h6 class="text-sm">{{ $reservacion->id }}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{ $reservacion->codigo }}</h6>
                            </td>

                            <td>
                                <h6 class="text-sm">{{ $reservacion->room->name }}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{ $reservacion->cliente->nombre }}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{ $reservacion->fecha_entrada }} {{ $reservacion->hora_entrada }}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{ $reservacion->fecha_Salida }} {{ $reservacion->fecha_salida }}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{ $reservacion->comentario }}</h6>
                            </td>


                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>


            </div>

        </div>
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
