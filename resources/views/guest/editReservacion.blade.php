@extends('layouts.guest')
@section('content')
<div class="container-fluid">
    <header class="card my-2 p-4">
        <h3>Consultando la reservación con código: {{ $reservacion->codigo }}</i></h3>
    </header>

    <div class="card">

        <div class="card-body">
            <div class="card-header">
                <span>Datos personales</span>
            </div>

            <div class="row" id="buscador">
                <div class="col-6">
                    <div class="form-group">
                        <label for="cliente">N° de documento</label>
                        <div class="input-group">
                            <input readonly class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" name="documento" id="documento" value="{{$reservacion->cliente->documento}}">
                         </div>
                    </div>
                 
                </div>
            </div>

            <div id="formRegistro" >
                <div class="row" id="datosPersonales">
                    <div class="col">
                        <div class="form-group">
                            <label for="cliente">Nombre(s)</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" readonly value="{{$reservacion->cliente->nombre}}">
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cliente">Apellido paterno</label>
                            <input class="form-control" type="text" name="apellido_p" id="apellido_p" readonly value="{{$reservacion->cliente->apellido_p}}">
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cliente">Apellido materno</label>
                            <input class="form-control" type="text" name="apellido_m" id="apellido_m" readonly value="{{$reservacion->cliente->apellido_m}}">
                        </div>

                    </div>
                </div>

                <div id="datosContacto">
                    <div class="card-header">
                        Datos de contacto
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Correo electrónico</label>
                                <input class="form-control" type="text" name="correo" id="correo" readonly value="{{$reservacion->cliente->email}}">
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Teléfono</label>
                                <input class="form-control" type="text" name="telefono1" id="telefono1" readonly value="{{$reservacion->cliente->telefono_1}}"> 
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Teléfono alternativo</label>
                                <input class="form-control" type="text" name="telefono2" name="telefono2" readonly value="{{$reservacion->cliente->telefono_2}}">
                            </div>

                        </div>
                    </div>
                </div>

                <div id="datosReservacion">
                    <div class="card-header">
                        Datos de la reservación
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha_entrada" class="form-check-label">Fecha de entrada</label>
                                        <input readonly id="fecha_entrada" class="form-control" type="date" name="fecha_entrada"  value="{{$reservacion->fecha_entrada}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hora_entrada" class="form-check-label">Hora de entrada</label>
                                        <input readonly id="hora_entrada" class="form-control" type="time" name="hora_entrada" value="{{$reservacion->hora_entrada}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha_entrada" class="form-check-label">Fecha de salida</label> 
                                        <input readonly id="fecha_entrada" class="form-control" type="date" name="fecha_salida"  value="{{$reservacion->fecha_salida}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hora_entrada" class="form-check-label">Hora de salida</label>
                                        <input readonly id="hora_entrada" class="form-control" type="time" name="hora_salida" value="{{$reservacion->hora_salida}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-muted">  <button type="button" name="" id="" class="btn btn-danger btn-lg btn-block" data-toggle="modal"
            data-target="#cancelarReservacion">Cancelar reservacion</button>
    
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
