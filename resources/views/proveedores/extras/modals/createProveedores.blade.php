<div class="modal fade" id="addProveedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar un ingrediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('proveedores.store', ['establishment_id' => $establishment_id]) }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <label for="">Nombre</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Numero</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" name="numero">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Dirección</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="direccion" name="direccion">
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
