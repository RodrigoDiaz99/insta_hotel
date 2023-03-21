@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <header class="card my-2 p-4">
            <h3>Editando la reservación con código: {{ $reservacion->codigo }}</i></h3>
        </header>

        <div class="card">
            <div class="card-header">
                Datos de la reservación
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <button type="button" name="" id="" class="btn btn-danger btn-lg btn-block" data-toggle="modal"
                            data-target="#cancelarReservacion">Cancelar reservacion</button>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tarifa_tab" role="tab">Tarifa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dias" role="tab">Días</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tarifa_tab" role="tabpanel">
                                    <div class="form-group">
                                        <select title="Tarifa..." id="tarifa" class=" form-control selectpicker" data-live-search="true"
                                            data-style="form-control" name="tarifa">
                                            @foreach ($room->tarifas as $tarifa)
                                                <option value="{{ $tarifa->id }}">{{ $tarifa->descripcion_corta }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="dias" role="tabpanel">
                                    <div class="form-group">

                                        <select id="dias" class="selectpicker form-control" data-live-search="true" data-style="form-control" name="dias">
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input id="tipoHabitacion" class="form-check-input" type="checkbox" name="" value="true">
                            <label for="tipoHabitacion" value="{{ $reservacion->tipo_habitacion }}" class="form-check-label">Activar por tipo de habitación</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fecha_entrada" class="form-check-label">Fecha de entrada</label>
                                    <input id="fecha_entrada" value="{{ $reservacion->fecha_entrada }}" class="form-control" type="date" name="fecha_entrada"
                                        value="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="hora_entrada" class="form-check-label">Hora de entrada</label>
                                    <input id="hora_entrada" value="{{ $reservacion->hora_entrada }}" class="form-control" type="time" name="hora_entrada"
                                        value="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                <button type="button" id="submit" class="btn btn-success">Siguiente</button>
            </div>

        </div>


    </div>
    </div>
    @include('reservaciones.cancelarReservacion')
@endsection

@section('scripts')
    <script src="{{ asset('js/messages.js') }}"></script>
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').on('click', function() {
                $.ajax({
                    url: "{{ route('actualizar.reservacion') }}",
                    method: 'post',
                    data: {
                        reserva_id: '{{ $reservacion->id }}',
                        room_id: '{{ $room->id }}',
                        fecha_entrada: $('#fecha_entrada').val(),
                        hora_entrada: $('#hora_entrada').val(),
                        tarifa: $('#tarifa').val(),
                        tipo_habitacion: $('#tipoHabitacion').is(":checked") ? 1 : 0,
                    },
                    success: function(response) {
                        swal_success_redirect(response.message, response.redirect);
                    },


                    error: function(response) {
                        if (response.status != 422) {
                            swal_error('Ha ocurrido un error inesperado.');
                        }
                        validate(response);
                    }
                })
            })

            $('#btnCancelar').on('click', function() {
                var comentario = $('#comentario').val();
                $.ajax({
                    url: "{{ route('cancelar.reservacion') }}",
                    method: 'post',
                    data: {
                        reserva_id: '{{ $reservacion->id }}',
                        comentario: comentario
                    },
                    success: function(response) {
                        swal_success_redirect(response.message, response.redirect);
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
