@include('mensajes.error')
@include('mensajes.success')
@include('mensajes.errores')
@include('mensajes.update')
@include('mensajes.deleted')
  <div class="modal fade" id="incidente-{{$clientes->id}}" tabindex="-1" aria-labelledby="incidente-{{$clientes->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="incidente-{{$clientes->id}}">Reportar incidente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('incidentes.store') }}" method="post">
              @csrf                  
                <div class="form-group row-sm-4"><!--INICIO DE LAS FILAS-->
                      <label for="cliente_id">Cliente reportado</label>
                      <select name="cliente_id" id="cliente_id" class="form-control">
                          <option value="{{$clientes->id}}"> {{$clientes->nombre}} {{$clientes->apellido_p}}</option>
                      </select>
                </div>
                <div class="form-group row-sm-4">
                      <label for="nivel">Nivel</label>
                      <select name="nivel" id="nivel" class="form-control">
                          <option value="">Seleccione nivel</option>
                          <option value="Alta">Alta</option>
                          <option value="Media">Media</option>
                          <option value="Baja">Baja</option>
                      </select>
                </div>
                <div class="form-group row-sm-4">
                    <label for="mensaje">Mensaje</label>
                    <input type="text" name="mensaje" id="mensaje" autocomplete="off" class="form-control">
                </div>
                <div class="form-group row-sm-4">
                    <label for="lugar">Lugar</label>
                    <input type="text" name="lugar" id="lugar" autocomplete="off" class="form-control">
                </div><!--FIN DE LAS FILAS-->

                <div class="form-group col">
                  <label for="compartir">Compartir con: </label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="vsuites" id="vsuites">
                      <label class="form-check-label" for="vsuites">
                        Vsuites
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="2" name="lavanda" id="lavanda" >
                      <label class="form-check-label" for="lavanda">
                        Lavanda
                      </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success">Guardar</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
