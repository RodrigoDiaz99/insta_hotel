<div class="modal fade" id="addProductRecipe" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto<h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.storeRecipe', ['establishment_id' => $establishment_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <label for="">Imagen</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="file" id="image"
                                    name="image">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Nombre Producto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="text" id="name"
                                    name="name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Familia producto</label>
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
                        <label for="">Descripción</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control form-control-alternative" placeholder="Nombre tipo producto" type="text" id="description"
                                    name="description">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="ingredientesCheck">
                            <label class="form-check-label" for="ingredientesCheck">El producto lleva múltiples insumos</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group" id="ingredients">
                            <div class="recipe input-group input-group-alternative mb-4" id="recipe">
                                <select class="form-control" name="currentRecipe[]" id="currentRecipe[]">
                                    <option value="">SELECCIONE INSUMO</option>
                                    @foreach ($ingredients as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control" placeholder="Cantidad" type="text" id="usedQuantity[]" name="usedQuantity[]">
                                <button type="button" class="removeIngredient btn btn-danger" disabled><i class="fa fa-minus-circle" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <button type="button" class="addIngredient btn btn-success" id="addIngredient"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>

                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><strong>GUARDAR</strong></button>
            </div>
            </form>
        </div>

    </div>
</div>
