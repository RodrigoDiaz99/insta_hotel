<div class="modal fade" id="editTipo" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar tipo de habitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tiposhabitacion.update') }}" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="tipo_id" id="edit_id" value="">

                    <input type="hidden" name="establishment_id" value="{{ $establishment_id }}">
                    <div class="col-md-12">
                        <label for="">Nombre</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <input class="form-control form-control-alternative" placeholder="Nombre" type="text" id="edit_name" name="name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                     <button type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
