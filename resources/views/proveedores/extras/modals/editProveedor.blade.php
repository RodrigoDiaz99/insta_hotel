<div class="modal fade" id="editProveedor-{{$row->id}}" data-backdrop="static" datakeyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar ingrediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('proveedores.update', $row->id, ['establishment_id' => $establishment_id]) }}" method="POST">
                    @csrf
@method('PUT')
                    <div class="col-md-12">
                        <label for="">Nombre</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="name" name="name" value="{{$row->nombre}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Numero</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" name="numero" value="{{$row->numero}}" maxlength="13" >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Dirección</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="direccion" name="direccion" value="{{$row->direccion}}" >
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn btn-success"><strong>Guardar</strong></button>
            </div>
            </form>
        </div>

    </div>
</div>
