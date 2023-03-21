@extends('layouts.app')
@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')

    <div class="container-fluid">
        <form action="{{ route('ventas.store', ['establishment_id' => $establishment->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <header class="card p-4">
                <h3 class="h2">Registrar venta</h3>
                <div class="d-flex ">
                    <div class="form-group col-sm d-flex flex-column ">
                        <div class="form-group row">
                            <label class="col-form-label">Fecha: </label>
                            <div class="col">
                                <input value="{{ date('d/m/Y') }}" class="form-control form-control-alternative">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">Establecimiento: </label>
                                <div class="col">
                                    <input readonly value="{{ $establishment->name }}" class="form-control form-control-alternative">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Usuario: </label>
                            <div class="col">
                                <input readonly value="{{ Auth::user()->name }}" class="form-control form-control-alternative">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm d-flex flex-column">

                        <div class="form-group row">
                            <label class="col-form-label">Habitacion </label>
                            <div class="col">
                                <select name="habitacion_id" id="habitacion_id" class="form-control">
                                    <option value="">Selecciona una habitación</option>
                                        @foreach($habitaciones as $habitacion)
                                            @if($establishment->id === $habitacion->establishments_id)
                                                <option value="{{$habitacion->id}}">{{$habitacion->name}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Lugar de venta </label>
                            <div class="col">
                                <input type="text" name="sitio_venta" id="sitio_venta" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Método de pago </label>
                                <div class="col">
                                    <select name="tipo_pago" id="tipo_pago" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>
                        </div>
                    </div>

                    <div class="form-group col-sm d-flex flex-column">
                        <div class="form-group row">
                            <label class="col-form-label">Folio: </label>
                            <div class="col">
                                <div class="input-group input-group-alternative  ">
                                    <span class="input-group-text ">C-</span>
                                    <input name="folio" class="form-control form-control-alternative" placeholder="000001 (opcional)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Comentarios </label>
                            <div class="col">
                                <input type="text" name="comentarios" id="comentarios" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="form-group col">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div>
                            <div class="form-group col">
                                <button type="button" class="btn btn-danger btn-block">Cancelar</button>
                            </div>
                        </div>
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
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="detallesTableVenta" class="detallesTableVenta">
                                                    <tr id="productRowVenta" class="productRowVenta">
                                                        <td>
                                                            <h6 class="text-sm"> 1</h6>
                                                        </td>

                                                        <td>
                                                            <select class="form-control" name="producto[]" id="producto">
                                                                <option value="">SELECCIONE</option>
                                                                @foreach ($productos as $producto)
                                                                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input name="cantidad_venta[]" type="number" class="cantidad_venta form-control">
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm">
                                                                <div class="input-group ">
                                                                    <span class="input-group-text ">$</span>
                                                                    <input name="precio_unitario[]" type="number" class="precio_unitario form-control">
                                                                </div>
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-sm">$ <span class="subtotal" name="subtotal[]">0.00</span></h6>
                                                        </td>

                                                        <td>
                                                            <button type="button" class="addProduct btn btn-success"><i class="fa fa-plus-circle"
                                                                    aria-hidden="true"></i></button>
                                                            <button type="button" disabled class="removeProduct btn btn-danger"><i class="fa fa-minus-circle"
                                                                    aria-hidden="true"></i></button>
                                                        </td>

                                                    </tr>

                                                <tfoot>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <h6 class="text-sm">$ <span class="total" name="total" id="total">0.00</span></h6>
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
