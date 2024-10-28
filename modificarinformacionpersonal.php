<!-- Modal de Edición de Información Personal -->
<div class="modal fade" id="editPersonalInfoModal" tabindex="-1" aria-labelledby="editPersonalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPersonalInfoModalLabel">Editar Información Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="w-75" id="personalInfoForm" method="POST" action="actualizar_informacion_personal.php" enctype="multipart/form-data">
                    <div class="mb-3 text-center">
                        <img src="<?php echo $usuario['ImagenUsuario']; ?>" alt="Foto de Usuario" class="img-fluid rounded-circle mb-3" style="max-width: 100px;">
                        <input type="file" class="form-control <?php echo $imageError != '' ? 'is-invalid' : ''; ?>" name="image" accept="image/*">
                        <div class="invalid-feedback">
                            <?php echo isset($imageError) ? $imageError : '' ?>
                        </div>
                        <small class="form-text text-muted">Selecciona una nueva foto si deseas cambiarla.</small>
                    </div>
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?php echo htmlspecialchars($usuario['NombreUsuario']); ?>" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su nombre.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoUsuario" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellidoUsuario" name="apellidoUsuario" value="<?php echo htmlspecialchars($usuario['ApellidoUsuario']); ?>" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su apellido.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" value="<?php echo htmlspecialchars($usuario['EmailUsuario']); ?>" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese un email válido.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoUsuario" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefonoUsuario" name="telefonoUsuario" value="<?php echo htmlspecialchars($usuario['TelefonoUsuario']); ?>" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su teléfono.
                        </div>
                    </div>
                    <button type="submit" class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
