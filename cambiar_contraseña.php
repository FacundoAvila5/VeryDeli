<!-- Modal para Cambiar Contraseña -->
<div class="modal fade" id="cambiarContraseña" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="w-75" id="changePasswordForm" method="POST" action="actualizar_contraseña.php" novalidate>
                    <div class="mb-3">
                        <label for="nuevaContrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="nuevaContrasena" name="nuevaContrasena" required>
                        <div class="invalid-feedback">Por favor, ingresa una nueva contraseña.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmarContrasena" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" required>
                        <div class="invalid-feedback">Por favor, confirma tu nueva contraseña.</div>
                    </div>
                    <button type="submit" class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>
