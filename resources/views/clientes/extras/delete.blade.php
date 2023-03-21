<div class="modal fade" id="delete-{{$clientes->id}}" tabindex="-1" aria-labelledby="delete-{{$clientes->id}}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-{{$clientes->id}}Label">Eliminar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x" style="color:#F6C324;"></i>
                    <p>¿Está seguro(a) de eliminar el registro del cliente  "{{$clientes->nombre}}" ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                <a href="{{route('clientes.delete', $clientes->id)}}" class="btn btn-sm btn-danger">Si,
                    eliminar</a>
            </div>
        </div>
    </div>
</div>