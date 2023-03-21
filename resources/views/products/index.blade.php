@extends('layouts.app')
@section('content')
    @include('mensajes.error')
    @include('mensajes.success')
    @include('mensajes.errores')
    @include('mensajes.update')
    @include('mensajes.deleted')

    <div class="container-fluid">
        <header class="card p-4 ">
            <h3 class="h2">Productos</h3>
            <div class="d-flex flex-row">
                @if ($productfamily->isEmpty())
                    <button type="button" onclick="noProductType()" class="btn   btn-secundary btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        <span class="btn-inner--text">Agregar Producto</span>
                    </button>
                @else
                    <button type="button" class="btn btn-success   " data-toggle="modal" data-target="#addProductRecipe">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        <span class="btn-inner--text">Agregar Producto</span>
                    </button>
                @endif

                <button type="button" class="btn btn-success  " data-toggle="modal" data-target="#addProductType">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    <span class="btn-inner--text ">Familia de Productos</span>
                </button>
            </div>
        </header>


        <div class="card p-2">
            <div class="container-fluid pt-4">
                <div class="row ">

                    @forelse ($producto as $row)
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header">
                                    <img src="{{ asset('storage/' . $row->path) }}" alt="profile Pic" class="img-fluid rounded ">

                                </div>

                                <div class="card-body d-flex flex-column">
                                    <span class="card-title h4 d-block text-darker">
                                        {{ $row->name }}
                                    </span>

                                    <span class="text-gradient text-primary   text-xs font-weight-bold ">
                                        <span>{{ $row->description }}</span>
                                    </span>


                                    <span class="text-xs font-weight-bold my-2">
                                        <strong>Tipo de producto: </strong><span>{{ $row->type }}</span>
                                    </span>



                                    <span> <strong>Ingredientes: </strong>
                                        @forelse ($row->ingredients as $row_ingredients)
                                            <p class="font-weight-bold text-xs">
                                                • {{ $row_ingredients->name }} - {{ $row_ingredients->pivot->quantity }}g
                                            </p>
                                        @empty
                                            <h6 class="text-sm">No aplica</h6>
                                        @endforelse
                                    </span>

                                    <section class="row">

                                        <div class="col">
                                            <form action="{{ route('product.delete', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-block btn-danger"><i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </section>

                                    <div class="author align-items-center">

                                        <div class="name ps-3">
                                            <div class="stats">
                                                {{-- <p class="font-weight-light font-italic text-xs">Agregado: {{ $row->created_at->format('d-m-Y') }}</p> --}}
                                                @if (!is_null($row->created_at))
                                                <p class="font-weight-light font-italic text-xs">Agregado: {{ date('j F, Y', strtotime($row->created_at)) }}</p>
                                                @else
                                                <p class="font-weight-light font-italic text-xs">Agregado: Sin Fecha</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center mt-3">
                            <strong class="h4 text-danger">NO HAY PRODUCTOS PARA MOSTRAR</strong>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('products.extras.modals.productType')
    @include('products.extras.modals.createProduct')
    @include('products.extras.modals.createProductRecipe')
    @include('products.extras.modals.editProduct')
    @include('products.extras.modals.editProductRecipe')
    @include('products.extras.modals.createProductType')
    @include('products.extras.modals.imagePreview')
@endsection

@section('scripts')
    <script>
        var url_product_edit = "{{ route('product.edit') }}"
        var url_product_update = "{{ route('product.update') }}"
        var token = '{{ csrf_token() }}'
        let ruta_list = "{{ route('product.list', ['establishment_id' => $establishment_id]) }}"
    </script>
    <script src="{{ asset('js/productos/producto.js') }}"></script>
@endsection
