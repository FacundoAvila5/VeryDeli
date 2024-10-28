<!-- Modal para validar persona -->
<div class="modal fade" id="validarUser" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="publishModalLabel">Datos necesarios para validar perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="verificar" action="GuardarPedidoValidacion.php" method="post" class="needs-validation" novalidate>
                
            <div class="mb-3">
                <label for="tituloPubli" class="form-label">DNI</label>
                <input type="text" class="form-control" id="tituloPubli" name="tituloPubli" placeholder="Ingrese su DNI" required>
                <div class="invalid-feedback">
                    El DNI es obligatorio. 
                </div>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="provinciaorigen" class="form-label">CUIL</label>
                        <input type="text" class="form-control" id="provinciaorigen" name="provinciaorigen" placeholder="Ingrese su CUIL" required>
                        <div class="invalid-feedback">
                            El CUIL es obligatorio.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br><label for="Localidadorigen" class="form-label">Boleta de servicio a su nombre</label>
                        <input type="file" class="form-control" id="Localidadorigen" name="Localidadorigen" required>  
                        <div class="invalid-feedback">
                            Por favor, seleccione una boleta de pago de servicios a su nombre.
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="verificar" class="btn text-white" style="background-color: rgb(18, 146, 154);">Enviar</button>
        </div>
        </div>
    </div>
</div>

<!-- Script de Bootstrap para mensaje de error en formulario -->
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