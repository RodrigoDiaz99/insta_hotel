<div class="modal fade" id="editarea-{{ $row->id }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar un área de habitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('room_area.update', $row->id, ['establishment_id'=>$establishment_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="">Nombre del área</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <input class="form-control form-control-alternative" placeholder="Nombre" type="text" id="name" name="name" value="{{$row->name}}">
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
