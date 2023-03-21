@include('mensajes.error')
@include('mensajes.success')
@include('mensajes.errores')
@include('mensajes.update')
@include('mensajes.deleted')
<div class="modal fade" id="delete-{{$incidente->id}}" tabindex="-1" aria-labelledby="delete-{{$incidente->id}}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-{{$incidente->id}}">Eliminar incidente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x" style="color:#F6C324;"></i>
                    <p>¿Está seguro(a) que desea eliminar el incidente ?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Cancelar</button>
                <a href="{{route('incidentes.delete', $incidente->id)}}" class="btn btn-md btn-danger">Si,
                    eliminar</a>
            </div>
        </div>
    </div>
</div>