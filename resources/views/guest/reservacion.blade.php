@extends('layouts.guest')
@section('content')
    <div class="container-fluid">
        <header class="card my-2 p-4">
            <h3>Crear una reservación para la habitación <i> {{ $room->name }}</i></h3>
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
                                <input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" name="documento" id="documento">
                                <div class="input-group-append"><button type="button" id="buscarCliente" class="btn btn-primary ">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="noRegistrado">Soy nuevo</button>
                            <button type="button" class="btn btn-primary" id="registrado" hidden>Estoy registrado</button>
                        </div>
                    </div>
                </div>

                <div id="formRegistro">
                    <div class="row" id="datosPersonales">
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Nombre(s)</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" readonly>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Apellido paterno</label>
                                <input class="form-control" type="text" name="apellido_p" id="apellido_p" readonly>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cliente">Apellido materno</label>
                                <input class="form-control" type="text" name="apellido_m" id="apellido_m" readonly>
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
                                    <input class="form-control" type="text" name="correo" id="correo" readonly>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cliente">Teléfono</label>
                                    <input class="form-control" type="text" name="telefono1" id="telefono1" readonly>
                                </div>

                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cliente">Teléfono alternativo</label>
                                    <input class="form-control" type="text" name="telefono2" id="telefono2" readonly>
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
                                        <div class="card-header">
                                            Checkin
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="fecha_entrada" class="form-check-label">Fecha de checkin</label>
                                                <input id="fecha_entrada" class="form-control" type="date" name="fecha_entrada" value="true">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="hora_entrada" class="form-check-label">Hora de checkin</label>
                                                <input id="hora_entrada" class="form-control" type="time" name="hora_entrada" value="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card-header">
                                            Checkout
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="fecha_salida" class="form-check-label">Fecha de checkout</label>
                                                <input id="fecha_salida" class="form-control" type="date" name="fecha_salida" value="true">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="hora_salida" class="form-check-label">Hora de checkout</label>
                                                <input id="hora_salida" class="form-control" type="time" name="hora_salida" value="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-muted">
                <button type="button" id="submit" class="btn btn-success" hidden>Reservar</button>
                <button type="button" id="save_submit" class="btn btn-success" hidden>Registrarme y reservar</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/messages.js') }}"></script>
    <script>
        $(function() {
            var cliente_id = 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#documento').on('keypress', function(e) {
                if (e.which == 13) {
                    $('#buscarCliente').click();
                }
            });

            $('#buscarCliente').on('click', function() {
                $.ajax({
                    url: "{{ route('buscar.cliente') }}",
                    method: 'get',
                    data: {
                        documento: $('#documento').val()
                    },
                    beforeSend: function() {},

                    success: function(response) {
                        cargarInfo(response.cliente);
                    },

                    error: function(response) {
                        if (response.status == 422) {
                            swal_error('Ha ocurrido un error inesperado.');
                        }
                        swal_error(response.responseJSON.message);
                    }
                })
            })

            $('#save_submit').on('click', function() {
                $.ajax({
                    url: "{{ route('crear.reservacion.guest.register') }}",
                    method: 'post',
                    data: {
                        establishment_id: '{{ $room->establishments_id }}',
                        room_id: '{{ $room->id }}',
                        fecha_entrada: $('#fecha_entrada').val(),
                        hora_entrada: $('#hora_entrada').val(),
                        fecha_salida: $('#fecha_salida').val(),
                        hora_salida: $('#hora_salida').val(),
 
                        nombre:$('#nombre').val(),
                        apellido_p:$('#apellido_p').val(),
                        apellido_m:$('#apellido_m').val(),
                        telefono_1:$('#telefono1').val(),
                        telefono_2:$('#telefono2').val(),
                        email:$('#correo').val(),
                        documento:$('#documento').val(),

                    },
                    success: function(response) {
                        swal_success_redirect(response.message, response.redirect);
                    },
                    error: function(response) {
                        if (response.status != 422) {
                            swal_error('Ha ocurrido un error inesperado.');
                        }
                        swal_error('Ha ocurrido un error inesperado.');
                    }
                })
            })

            $('#submit').on('click', function() {
                $.ajax({
                    url: "{{ route('crear.reservacion.guest') }}",
                    method: 'post',
                    data: {
                        establishment_id: '{{ $room->establishments_id }}',
                        room_id: '{{ $room->id }}',
                        fecha_entrada: $('#fecha_entrada').val(),
                        hora_entrada: $('#hora_entrada').val(),
                        fecha_salida: $('#fecha_salida').val(),
                        hora_salida: $('#hora_salida').val(),
                        cliente: cliente_id,
                     },
                    success: function(response) {
                        swal_success_redirect(response.message, response.redirect);
                    },
                    error: function(response) {
                        if (response.status != 422) {
                            swal_error('Ha ocurrido un error inesperado.');
                        }
                        swal_error('Ha ocurrido un error inesperado.');
                    }
                })
            })


            function cargarInfo(cliente) {
                $('#buscador').attr('hidden');
                $('#formRegistro').removeAttr('hidden');
                $('#nombre').val(cliente.nombre).attr('readonly', true);
                $('#apellido_p').val(cliente.apellido_p).attr('readonly', true);
                $('#apellido_m').val(cliente.apellido_m).attr('readonly', true);
                $('#telefono1').val(cliente.telefono_1).attr('readonly', true);
                $('#telefono2').val(cliente.telefono_2).attr('readonly', true);
                $('#correo').val(cliente.email).attr('readonly', true);
                $('#save_submit').attr('hidden', true);
                $('#submit').removeAttr('hidden');
                cliente_id = cliente.id;
            }

            $('#noRegistrado').on('click', function() {

                $('#formRegistro').removeAttr('hidden');
                $('#nombre').val('').removeAttr('readonly', true);
                $('#apellido_p').val('').removeAttr('readonly', true);
                $('#apellido_m').val('').removeAttr('readonly', true);
                $('#telefono1').val('').removeAttr('readonly', true);
                $('#telefono2').val('').removeAttr('readonly', true);
                $('#correo').val('').removeAttr('readonly', true);
                $('#save_submit').removeAttr('hidden');
                $('#submit').attr('hidden', true);
            })

            function crearRegistro() {

            }
        })
    </script>
@endsection
