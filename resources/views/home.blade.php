@extends('layouts.guest')

@section('content')
    <div class="container-fluid">

        <div class="row ">
            <div class="col my-5  flex-column">
                <div class="row d-flex justify-content-center">
                    <div>
                        <h1 class="text-white"> ¡Bienvenido a EasyMotel!</h1>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-center">
                        <h2><a href="{{ route('establecimientos') }}" class="text-primary">¡Realiza tu reservación ahora mismo!</a></h2>
                        <h4><a class="text-primary" href="#" id="buscarModal" data-toggle="modal" data-target="#buscarReservacion">Ya tengo una reservacion</a>
                        </h4>
                    </div>

                </div>
            </div>
        </div>


        <div class="full_wide bg-white">
            <div class="col my-5">
                <div class="row d-flex justify-content-center">
                    <div>
                        <h1> Las mejores habitaciones de la ciudad</h1>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div>
                        <h2><a class="text-primary" href="{{ route('establecimientos') }}">¡Descubre las posibilidades que EasyMotel puede ofrecerte!</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('reservaciones.buscarReservacion')
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        })

        $('#btnBuscar').on('click', function() {
            let codigo = $('#codigo').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('buscar.reservacion') }}",
                data: {
                    codigo: codigo,
                },
                contentType: 'application/x-www-form-urlencoded',
                success: function(response) {
                    swal_success_redirect(response.message, response.redirect)
                },


                error: function(xhr, status, error) {

                    swal_error(xhr.responseJSON.message)
                }
            });
        });
    </script>
@endsection
