@extends('layouts.app')
@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')

    <div class="container-fluid">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <header class="card p-4">
                <h3 class="h2">Detalles de la Venta</h3>
                <div class="d-flex ">
                    <div class="form-group col-sm d-flex flex-column ">
                        <div class="form-group row">
                            <label class="col-form-label">Fecha: </label>
                            <div class="col">
                                <input readonly value="{{ $ventas->created_at->format('d/m/Y') }}" class="form-control form-control-alternative">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">Usuario: </label>
                            <div class="col">
                                <input readonly value="{{ $ventas->user->name }}" class="form-control form-control-alternative">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">Establecimiento: </label>
                            <div class="col">
                                <input readonly value="{{ $ventas->establishment->name }}" class="form-control form-control-alternative">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm d-flex flex-column">
                        <div class="form-group row">
                            <label class="col-form-label">Folio: </label>
                            <div class="col">
                                <div class="input-group input-group-alternative  ">
                                    <span class="input-group-text ">C-</span>
                                    <input disabled name="folio" class="form-control form-control-alternative" value="{{ $ventas->folio }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Método de pago </label>
                            <div class="col">
                                <input readonly value="{{ $ventas->tipo_pago }}" class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Comentarios </label>
                            <div class="col">
                                <input readonly value="{{ $ventas->comentarios }}" class="form-control form-control-alternative">
                            </div>
                        </div>
                    </div>

                        @if (!$ventas->cancelado)
                            <div class="form-group row">
                                {{-- <div class="form-group col">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div> --}}
                                <div class="form-group col"> <a type="button" href="{{ route('ventas.cancel', ['venta_id' => $ventas->id]) }}"
                                        class="btn btn-danger btn-block">Cancelar compra</a> </div>
                            </div>
                        @endif
                    </div>

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
                                                        <th>#</th>
                                                        {{-- <th>Foto</th> --}} <th class="w-25">Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio unitario</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="detallesTable" class="detallesTable">

                                                    @foreach ($ventas_detalles as $i => $venta_detalle)
                                                        <tr id="productRow" class="productRow">
                                                            <td>
                                                                <h6 class="text-sm">{{ $i + 1 }} </h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-sm font-weight-normal">{{ $venta_detalle->product->name }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-sm font-weight-normal">{{ $venta_detalle->cantidad_venta }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-sm font-weight-normal">$ {{ $venta_detalle->precio_unitario }}</h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="text-sm"><span class="subtotal" name="subtotal">$ {{ $venta_detalle->subtotal }}</span></h6>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                <tfoot>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <h6 class="text-sm text-right">Total</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="text-sm"><span class="total" name="total" id="total">$
                                                                {{ $ventas->total_venta }}</span>
                                                        </h6>
                                                    </td>
                                                    <td></td>
                                                </tfoot>

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
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/productos/ventas.js') }}"></script>
@endsection
