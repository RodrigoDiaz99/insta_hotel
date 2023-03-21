<div class="modal fade" id="info_cliente-{{$clientes->id}}" tabindex="-1" role="dialog" aria-labelledby="info_cliente-{{$clientes->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informacion del cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group row">
                <div class="col-md-5">
                    <ul class="list-group">
                        <li class="list-group">
                            <h4>Nombre</h4>
                            <span>{{ $clientes->nombre }} {{ $clientes->apellido_p }} {{ $clientes->apellido_m }}</span>
                            <h4>Fecha de nacimiento</h4>
                            <span>{{ $clientes->fecha_n }}</span>
                            <h4>Sexo</h4>
                            <span>{{ $clientes->genero }}</span>
                            <h4>Origen</h4>
                            <span>{{ $clientes->origen }}</span>
                            <h4>Tipo de documento</h4>
                            <span>{{ $clientes->tipo_documento }}</span>
                            <h4>Documento</h4>
                            <span>{{ $clientes->documento }}</span>
                            <h4>Expedicion</h4>
                            <span>{{ $clientes->expedicion }}</span>
                            <h4>Pais documento</h4>
                            <span>{{ $clientes->pais_documento }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="list-group">
                        <li class="list-group">
                        <h4>Correo electronico</h4>
                            <span>{{ $clientes->email }}</span>
                            <h4>Direccion</h4>
                            <span>{{ $clientes->direccion }}</span>
                            <h4>Código postal</h4>
                            <span>{{ $clientes->codigo_postal }}</span>
                            <h4>Población</h4>
                            <span>{{ $clientes->poblacion }}</span>
                            <h4>Provincia</h4>
                            <span>{{ $clientes->provincia }}</span>
                            <h4>Telefono 1</h4>
                            <span>{{ $clientes->telefono_1 }}</span>
                            <h4>Telefono 2</h4>
                            <span>{{ $clientes->telefono_2 }}</span>
                            <h4>Observaciones</h4>
                            <span>{{ $clientes->observaciones }}</span>
                        </li>
                    </ul>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>