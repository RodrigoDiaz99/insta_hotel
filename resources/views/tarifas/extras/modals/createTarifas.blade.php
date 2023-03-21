<div class="modal fade" id="addTarifa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Tarifa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tarifa.store', ['establishment_id' => $establishment_id]) }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <label for="">Tipo Habitacion</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select name="room_types_id" id="room_types_id" class="form-control{{ $errors->has('room_types_id') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Rooms') }}" required>
                                    <option value="">Seleccione alguna opcion</option>
                                    @foreach ($tipo_habitacion as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == old('row_id') ? 'selected' : '' }}>{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Tramo</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <select name="tramos_id" id="tramos_id" class="form-control{{ $errors->has('rooms_id') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Rooms') }}" required>
                                    <option value="">Seleccione alguna opcion</option>
                                    @foreach ($tramo as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == old('row_id') ? 'selected' : '' }}>{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="">Descripcion Corta</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="descripcion_corta" name="descripcion_corta">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Descripcion larga</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="descripcion_larga" name="descripcion_larga">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Fecha Inicio Tarifa</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="datetime-local" id="date_inicio" name="date_inicio">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Fecha Fin Tarifa</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="datetime-local" id="date_fin" name="date_fin">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Importe Defecto</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="number" id="importe" name="importe">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Suplemento 3era Persona</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="text" id="suplemento" name="suplemento">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Tiempo Limpieza</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_limpieza" name="time_limpieza">
                            </div>
                        </div>
                    </div>
                    {{-- Hora incio --}}
                    <div class="col-md-12">
                        <label for="">Hora Inicio Lunes</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_lunes" name="time_lunes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Martes</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_martes" name="time_martes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Miercoles</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_miercoles" name="time_miercoles">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Jueves</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_jueves" name="time_jueves">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Viernes</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_viernes" name="time_viernes">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Sabado</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_sabado" name="time_sabado">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Hora Inicio Domingo</label>
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                <input class="form-control" type="time" id="time_domingo" name="time_domingo">
                            </div>
                        </div>
                    </div>

                    {{-- Tarifas --}}
                    <div class="col-md-12 align-self-center table-responsive">
                        <label for="">Días de tarifa permitidos</label>
                        <div class="form-group">
                            <table class="table  text-center">
                                <thead>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miércoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sábado</th>
                                    <th>Domingo</th>
                                </thead>
                                <tbody>
                                    <td><input type="checkbox" name="permitir_lunes" checked></td>
                                    <td><input type="checkbox" name="permitir_martes" checked></td>
                                    <td><input type="checkbox" name="permitir_miercoles" checked></td>
                                    <td><input type="checkbox" name="permitir_jueves" checked></td>
                                    <td><input type="checkbox" name="permitir_viernes" checked></td>
                                    <td><input type="checkbox" name="permitir_sabado" checked></td>
                                    <td><input type="checkbox" name="permitir_domingo" checked></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 align-self-center table-responsive">
                        <label for="">Días de tarifa permitidos</label>
                        <div class="form-group">
                            <table class="table  text-center">
                                <thead>
                                    <th>Activo</th>
                                    <th>Forzar Salida</th>
                                    <th>Incremental</th>

                                </thead>
                                <tbody>
                                    <td><input type="checkbox" name="estatus" checked></td>
                                    <td><input type="checkbox" name="forzar_salida" checked></td>
                                    <td><input type="checkbox" name="incremental" checked></td>

                                </tbody>
                            </table>
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
