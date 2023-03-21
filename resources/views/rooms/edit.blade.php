<div class="modal fade" id="editRoom-{{$room->id}}" data-backdrop="static" datakeyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar ingrediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form action="{{ route('room.update',$room->id ,$establishment_id) }}" method="POST">
                @csrf
@method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nombre Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{$room->name}}">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Descripción</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Descripcion" type="text" name="description" value="{{$room->description}}">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Precio Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" type="number" name="precio" id="precio" value="{{$room->price}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Capacidad Habitación</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text  "><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" id="capacidad" placeholder="Capacidad" name="capacidad"
                                    type="number" value="{{$room->room_capacity}}">
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <label>Tipo Habitación</label>

                            </div>

                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text @error('room.type') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <select class="form-control" name="room_type">
                                        <option value="">SELECCIONE</option>
                                        @foreach ( $establishment as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button type="submit" class="btn btn-success"><strong>Guardar</strong></button>
                </div>

            </form>

            </div>


        </div>

    </div>
</div>
