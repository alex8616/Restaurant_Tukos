<div wire:ignore.self class="modal fade" id="deleteArticuloModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Comfirma Si Quieres Borrar</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4 pb-4">
                <h2>Estas Seguro Que Quieres Borrar?</h2><br>
                <p style="color: #FF4040">Nota: el borrado cerra permante.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" wire:click="cerrarModal()" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button class="btn btn-sm btn-danger" wire:click="deleteStudentData()">Si! Borrar</button>
            </div>
        </div>
    </div>
</div>