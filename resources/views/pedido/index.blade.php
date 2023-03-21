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
                <h3 class="h2">Tiempo de Pedidos</h3>

                <a href="#" class="btn btn-icon btn-success d-flex align-items-center" data-toggle="modal" data-target="#addPedido">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text">Agregar Pedido</span>
                </a>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="h5">Administra los pedidos.</h3>
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
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pedido as $row)
                                                    <tr>
                                                        <td>
                                                            <h6 class="text-sm">{{ $row->products_id }}</h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm">{{ $row->cantidad }}</h6>
                                                        </td>
                                                        <td>
                                                            @if ($row->estatus == 1)
                                                                <h6 class="text-sm">En proceso</h6>
                                                            @elseif ($row->estatus == 2)
                                                                <h6 class="text-sm">En Camino</h6>
                                                            @elseif ($row->estatus == 3)
                                                                <h6 class="text-sm">Entregado</h6>
                                                            @endif

                                                        </td>


                                                        <td>
                                                            <div class="row">
                                                                @if ($row->estatus == 1)
                                                                    <div class="col-md-6">
                                                                        <form action="{{ route('pedido.update', $row->id) }}" method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button type="submit" class="btn btn-icon btn-success" title="En camino"><i
                                                                                    class="fas fa-car"> En
                                                                                    camino</i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <form action="{{ route('pedido.delete', $row->id) }}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-icon btn-success" title="Cancelar Pedido"><i
                                                                                    class="fas fa-trash"> Cancelar Pedido</i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @elseif ($row->estatus == 2)
                                                                    <div class="col-md-6">
                                                                        <form action="{{ route('pedido.update', $row->id) }}" method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button type="submit" class="btn btn-icon btn-success" title="En camino"><i
                                                                                    class="fas fa-box">
                                                                                    Entregado</i>
                                                                            </button>

                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                <button data-row_id="{{ $row->id }}" type="button"
                                                                    class="seguimientoBtn btn btn-icon btn-success" title="En camino"><i class=" fas fa-box">
                                                                        Seguimiento</i>
                                                                </button>


                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @include('pedido.extras.modals.editPedido')
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

    @include('pedido.extras.modals.createPedido')
    @include('pedido.extras.modals.seguimiento')
@endsection


@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-Token": $("meta[name=csrf-token]").attr("content")
            },
        });

        $('.seguimientoBtn').on('click', function() {

            var pedido_id = $(this).data('row_id');

            seguimiento(pedido_id);


        })

        function seguimiento(pedido_id) {
            var i = 0;

            $.ajax({
                url: " {{ route('pedido.seguimiento') }}",
                type: "post",
                dataType: "json",
                encoding: "UTF-8",
                async: true,
                cache: false,
                data: {
                    pedido_id: pedido_id,
                },
                beforeSend: function() {
                    swal.fire({
                        title: "Seguimiento",
                        text: "Cargando , Espere Por Favor...",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        },
                    });
                },
                success: function(data) {
                    //alert(JSON.stringify(data));
                    swal.close();
                    var seguimiento = "";
                    for (i; i < data.seguimiento.length; i++) {

                        seguimiento += '<div class="timeline-block">';
                        seguimiento +=
                            '<span class="timeline-step ' + data.seguimiento[i].estatus + '">';
                        seguimiento += "</span>";
                        seguimiento += '<div class="timeline-content">';

                        if (data.seguimiento[i].estatus == 1) {
                            seguimiento +=
                                '<h5 class="text-white">' + 'Preparando' +
                                "</h5>";
                        }else if(data.seguimiento[i].estatus == 2){
                            seguimiento +=
                                '<h5 class="text-white">' + 'En camino' +
                                "</h5>";
                        }else{
                            seguimiento +=
                                '<h5 class="text-white">' + 'Entregado' +
                                "</h5>";
                        }


                        seguimiento +=
                            '<p class="text-light text-sm mt-1 mb-0">' +
                            data.seguimiento[i].created_at.toUpperCase() +
                            "</p>";

                   /*      seguimiento +=
                            '<p class="text-light text-sm mt-1 mb-0">USUARIO: ' +
                            data.seguimiento[i].user_created_at.id.toUpperCase() +
                            "</p>";
 */

                        seguimiento += "</div>";
                        seguimiento += "</div>";
                    }
                    $("#lineaSeguimiento").html(seguimiento);

                    $("#modalSeguimiento").modal("show");
                },
                error: function(err) {
                    //alert(err);
                    swal.close();
                },
            });
        }
    </script>
@endsection
