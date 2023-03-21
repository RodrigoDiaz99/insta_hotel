<div class="modal fade" id="editEstablishmentAreas" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="m-2">
                <livewire:wifi-alert>
            </div>

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Áreas de Establecimientos</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>            </div>

            <div class="d-flex justify-content-center align-items-center">
                <div wire:loading wire:target='update'>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <strong class="ms-2">Cargando...</strong>
                </div>
            </div>

            <form wire:loading.remove wire:target='update' wire:submit.prevent='update'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nombre Área</label>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span
                                        class="input-group-text @error('establishmentAreaEdit.name') border border-danger text-danger @enderror"><i
                                            class="ni ni-zoom-split-in"></i></span>
                                    <input
                                        class="form-control @error('establishmentAreaEdit.name') is-invalid @enderror"
                                        placeholder="Nombre" wire:model='establishmentAreaEdit.name' type="text">
                                </div>
                                @error('establishmentAreaEdit.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" wire:offline.attr="disabled" class="btn btn-warning"
                        data-dismiss="modal"><strong>ACTUALIZAR</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
