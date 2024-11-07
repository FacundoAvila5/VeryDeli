<!-- Modal postularse -->

<div class="modal fade" id="modalpostularse" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publishModalLabel">Datos para postulacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body body-postu">
        <form id="publicacion" action="publicarmodalpostularse" method="post" class="needs-validation" novalidate>

          <!-- Campo de selección de vehículo
          <label for="vehiculo" class="form-label"><h4>Seleccionar vehículo</h4></label>
          <select class="form-select custom-input" id="vehiculo" name="vehiculo" required>
            <option value="" selected disabled>Seleccione su vehículo</option>
            <option value="vehiculo1">Vehículo 1</option>
            <option value="vehiculo2">Vehículo 2</option>
          </select>
          <div class="invalid-feedback">
            Debe seleccionar un vehículo.
          </div> -->

          <!-- Campo de monto -->
          <label for="comentario" class="form-label"><h4>Monto a cobrar</h4></label>
          <div class="input-group mb-3 monto">
            <span class="input-group-text custom-input-m" id="basic-addon1">$</span>
            <input type="number" class="custom-input form-control" aria-label="Username" aria-describedby="basic-addon1" id="monto" name="monto" placeholder="0.00,0" required>
            <div class="invalid-feedback">
              El monto a cobrar es obligatorio
            </div>
          </div>

          <!-- Campo de comentario -->
          <div class="mb-3">
            <label for="comentario" class="form-label">Comentario (opcional)</label>
            <textarea class="form-control custom-textarea" id="comentario" name="comentario"></textarea>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-deli" onclick="abrirSegundoModal()">Siguiente</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para confirmar postulacion -->
<div class="modal fade" id="publicarmodalpostularse" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publishModalLabel">Datos para postulacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body body-postu">
        <form id="publicacionFinal" action="GuardarPostulacion.php" method="post">
            
          <div class="input-group mb-3 ">
            <h3> <?php echo $_SESSION["usuario"] ?> </h3>
          </div>

        <div class="mb-3">
            <p>Importe a cobrar</p> 
            <h4 id="montoConfirmado"></h4>
            <input type="hidden" id="montoInput" name="monto">
        </div>

        <div class="mb-3">
            <h6 >Comentario</h6>
            <p id="comentarioConfirmado"></p>
            <input type="hidden" id="comentarioInput" name="comentario">
            <input type="hidden" id="idpublicacionconfirmada" name="idPubli">
        </div>

        <div class="modal-footer d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> <!-- style="background-color: rgb(70, 70, 70);" -->
        <button type="submit" class="btn btn-deli">Postularme</button> <!-- style="background-color: white;" -->
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="script.js"></script>

<!-- Script de Bootstrap para mensaje de error en formulario -->
<!-- <script>
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
</script> -->

