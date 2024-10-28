<div class="modal fade" id="modalDeletePost" tabindex="-1" aria-labelledby="modalDeletePost" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">¿Eliminar publicación?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modalDeletePost-body text-body-secondary">
                Esta acción es irreversible.
            </div>
            <div class="modal-footer modalDeletePost-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="eliminarPublicacion.php?id=<?php echo $idpost; ?>" id="deleteP" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>