<div class="modal fade" id="addTramo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Comanda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comanda.store', ['establishment_id' => $establishment_id]) }}" method="POST">

                    @csrf
                    <div class="col-md-12">
                        <label for="">Habitacion</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select name="room_id" id="room_id"
                                    class="form-control{{ $errors->has('rooms_id') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Rooms') }}" required>
                                    <option value="">Seleccione alguna opcion</option>
                                    @foreach ($habitacion as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $row->id == old('row_id') ? 'selected' : '' }}>{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Clave</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="clave" name="clave">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <label for="">Key Comanda</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="llave_comanda" name="llave_comanda"
                                    readonly>
                            </div>
                        </div>

                    </div>



                    <div class="col-md-12">
                        <label for="">Estatus</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select name="estatus" id="estatus"
                                    class="form-control{{ $errors->has('estatus') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('estatus') }}" required>
                                    <option value="" selected>Seleccione alguna opcion</option>
                                    <option value="0" selected>Sin Usar</option>
                                    <option value="1" selected>Usado</option>

                                </select>
                            </div>
                        </div>
                    </div>



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn btn-success" ><strong>GUARDAR</strong></button>
            </div>
            </form>
        </div>

    </div>
</div>
