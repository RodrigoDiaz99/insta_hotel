<div class="modal fade" id="addPedido" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pedido.store', ['establishment_id' => $establishment_id]) }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <label for="">Producto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select class="form-control{{ $errors->has('products') ? ' is-invalid' : '' }}"
                                    name="products_id" id="products_id">
                                    <option selected>Opciones</option>
                                    @foreach ($producto as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <label for="">Establecimiento</label>
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select class="form-control{{ $errors->has('establishment') ? ' is-invalid' : '' }}"
                                    name="establishment_id" id="establishment_id">
                                    <option selected>Opciones</option>
                                    @foreach ($establishment as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class="col-md-12">

                                <div class="row-6">
                                    <label for="">cantidad</label>

                                    <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad">

                                    </div>
                                </div>
                                <div class="row-6">
                                    <label for="">Estatus</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        <select
                                            class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}"
                                            name="estatus" id="estatus">
                                            <option selected>Opciones</option>

                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>




                                        </select>

                                    </div>
                                </div>


                            </div>
                            <label for="">Comentario</label>
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                               <textarea name="comentario" id="comentario" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            aria-label="Close">Cancelar</button>
                        <button type="submit" class="btn btn-success"><strong>Iniciar Pedido</strong></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
