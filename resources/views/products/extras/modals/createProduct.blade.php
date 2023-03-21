<div class="modal fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto (preparado)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.store', ['establishment_id' => $establishment_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <label for="">Imagen</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="file" id="image"
                                    name="image" >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Nombre Producto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="text" id="name"
                                    name="name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Familia de producto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select class="form-control" name="product_families_id" id="product_families_id">
                                    <option value="">SELECCIONE TIPO</option>
                                    @foreach ($productfamily as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Tipo Producto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select class="form-control" name="producttype" id="producttype">
                                    <option value="">SELECCIONE TIPO</option>
                                    <option value="Insumo">Insumo</option>
                                    <option value="Producto">Producto</option>
                                    <option value="Paquete">Paquete</option>
                                 </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Descripción</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="text" id="description"
                                    name="description">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>

                <button type="submit" class="btn btn-success"><strong>GUARDAR</strong></button>
            </div>
            </form>
        </div>

    </div>
</div>
</div>
