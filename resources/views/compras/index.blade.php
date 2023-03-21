@extends('layouts.app')
@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')

    <div class="container-fluid">
        <header class="card p-4">
            <h2 class="h2">Compras</h2>
            <div class="d-flex flex-column">
                <span class="py-2">Aquí puedes administrar las compras del establecimiento.</span>
                <div class="d-flex align-items-right py-2">
                    <a type="button" href="{{ route('compras.create', ['establishment_id' => $establishment_id]) }}" class="btn btn-icon btn-success">
                        <span> <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar compra</span></a>
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
                                                    <th class="w-25">Folio</th>
                                                    <th class="w-25">Fecha</th>
                                                    <th class="w-25">Total de compra</th>
                                                    <th class="w-25">Usuario</th>
                                                    <th class="w-25">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($compras as $row)
                                                    {!! $row->cancelado ? '<tr class="table-danger">' : '<tr>' !!}
                                                    <td>
                                                        <h6 class="text-sm">{{ $row->folio ? $row->folio : 'Sin especificar' }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="text-sm">{{ $row->created_at->format('d/m/Y') }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="text-sm">$ {{ $row->total_compra }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="text-sm">{{ $row->user()->first()->name }}</h6>
                                                    </td>
                                                    <td>
                                                        <div class="col d-flex justify-content-center ">
                                                            <div class="col  ">
                                                                <div class="row p-2"><a href="{{ route('compras.detalles', ['compra_id' => $row->id]) }}"
                                                                        class="btn btn-primary btn-block ">Ver
                                                                        detalles</a></div>
                                                                {{-- <div class="row p-2"><a type="button"
                                                                            href="{{ route('compras.detalles', ['compra_id' => $row->id]) }}"
                                                                            class="btn btn-primary btn-block">Imprimir nota</a></div> --}}
                                                            </div>
                                                            @if (!$row->cancelado)
                                                                <div class="col ">
                                                                    {{-- <div class="row p-2"><a type="button"
                                                                            href="{{ route('compras.detalles', ['compra_id' => $row->id]) }}"
                                                                            class="btn btn-primary btn-block">Descargar ticket</a></div> --}}

                                                                    <div class="row p-2"><a type="button"
                                                                            href="{{ route('compras.cancel', ['compra_id' => $row->id]) }}"
                                                                            class="btn btn-danger btn-block">Cancelar compra</a></div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    </tr>
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
@endsection


@section('scripts')
    <script></script>
@endsection
