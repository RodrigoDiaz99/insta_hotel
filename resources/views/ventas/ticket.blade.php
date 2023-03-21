<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{public_path('css/ticket.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    @foreach ($ventas as $venta)
    <h1>{{ $venta->establishment->name }}</h1>
    @endforeach
    <h2>Mérida-Yucatán</h2>
    <h2>México</h2>
    <h5>Comprobante de pago</h5>
    <table class="table align-items-center mb-0">
        <tbody>
            @foreach ($ventas as $venta)
                <h6 class="text-sm">Folio de venta: {{ $venta->folio }}</h6>
                <h6 class="text-sm">Fecha: {{ $venta->created_at->format('d/m/Y') }}</h6>
                @if(is_null($venta->habitacion_id))
                    <h6 class="text-sm">Sitio de venta: {{ $venta->sitio_venta }}</h6>
                @elseif($venta->habitacion_id !== null)
                    <h6 class="text-sm">Habitacion: {{$venta->room->name}}</h6>
                @endif
                <h6 class="text-sm">Metodo pago: {{$venta->tipo_pago}}</h6>
            @endforeach

        </tbody>
    </table>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Importe</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody id="detallesTable" class="detallesTable">

            @foreach ($ventas_detalles as $i => $venta_detalle)
                <tr id="productRow" class="productRow">
                    <td>
                        <h6 class="text-sm font-weight-normal">{{ $venta_detalle->cantidad_venta }}</h6>
                    </td>
                    <td>
                        <h6 class="text-sm font-weight-normal">{{ $venta_detalle->product->name }}</h6>
                    </td>
                    
                    <td>
                        <h6 class="text-sm font-weight-normal">${{ $venta_detalle->precio_unitario }}</h6>
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
                <h2 class="text-sm text-right">Total</h2>
            </td>
            <td>
                <h3 class="text-sm"><span class="total" name="total" id="total">$
                        {{ $venta->total_venta }}</span>
                </h3>
            </td>
            <td></td>
        </tfoot>

        </tbody>
    </table>
</body>
</html>