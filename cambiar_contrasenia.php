<body>
    <div class="modal fade" id="cambiarContrasenia" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="w-75 needs-validation" id="changePasswordForm" method="POST" action="actualizar_contrasenia.php" novalidate>
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
                        <div class="mb-3">
                            <div id="passwordError" class="invalid-feedback">Las contraseñas no coinciden.</div>
                        </div>
                        <button type="submit" class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Actualizar Contraseña</button>
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
                        // Validar contraseñas
                        const nuevaContrasena = document.getElementById('nuevaContrasena');
                        const confirmarContrasena = document.getElementById('confirmarContrasena');
                        const passwordError = document.getElementById('passwordError');

                        if (form.checkValidity() === false || nuevaContrasena.value !== confirmarContrasena.value) {
                            event.preventDefault();
                            event.stopPropagation();

                            if (nuevaContrasena.value !== confirmarContrasena.value) {
                                passwordError.style.display = 'block';
                            } else {
                                passwordError.style.display = 'none';
                            }
                        } else {
                            passwordError.style.display = 'none';
                            nuevaContrasena.classList.remove('is-invalid');
                            confirmarContrasena.classList.remove('is-invalid');
                        }

                        form.classList.add('was-validated');
                    }, false)
                })
        })()
    </script>
</body>
