@include('mensajes.error')
@include('mensajes.success')
@include('mensajes.errores')
@include('mensajes.update')
@include('mensajes.deleted')
  <div class="modal fade" id="edit-{{$incidente->id}}" tabindex="-1" aria-labelledby="edit-{{$incidente->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-{{$incidente->id}}">Reportar incidente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('incidentes.update', $incidente->id) }}" method="post">
              @csrf    
              {{method_field('PUT')}}              
                
                <div class="form-group row">
                      <label for="nivel">Nivel</label>
                      <select name="nivel" id="nivel" class="form-control">
                          <option value="">Seleccione nivel</option>
                          <option value="Alta" {{$incidente->nivel === 'Alta' ? 'selected': ''}}>Alta</option>
                          <option value="Media" {{$incidente->nivel === 'Media' ? 'selected': ''}}>Media</option>
                          <option value="Baja" {{$incidente->nivel === 'Baja' ? 'selected': ''}}>Baja</option>
                      </select>
                </div>
                <div class="form-group row">
                    <label for="mensaje">Mensaje</label>
                    <input type="text" name="mensaje" id="mensaje" autocomplete="off" class="form-control"
                    value="{{$incidente->mensaje}}">
                </div>
                <div class="form-group row">
                    <label for="lugar">Lugar</label>
                    <input type="text" name="lugar" id="lugar" autocomplete="off" class="form-control"
                    value="{{$incidente->lugar}}">
                </div>

                <div class="form-group col">
                  <label for="compartir">Compartir con: </label>
                    @if(auth()->user()->id == "2")
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="vsuites" id="vsuites"
                        {{$incidente->vsuites == '1' ?'checked' : ''}}>
                      <label class="form-check-label" for="vsuites">
                        Vsuites
                      </label>
                    </div>
                    @elseif(auth()->user()->id == "1")
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="2" name="lavanda" id="lavanda" 
                        {{$incidente->lavanda == '2' ?'checked' : ''}}>
                      <label class="form-check-label" for="lavanda">
                        Lavanda
                      </label>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success">Actualizar</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>