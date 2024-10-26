<!-- Modal postularse -->

<div class="modal fade" id="modalpostularse" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publishModalLabel">Datos para postulacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="publicacion" action="publicarmodalpostularse" method="post" class="needs-validation" novalidate>
       
         <label for="comentario" class="form-label"><h4>Monto a cobrar.</h4></label>
          <div class="input-group mb-3 monto">
            <span class="input-group-text custom-input-m" id="basic-addon1">$</span>
            <input type="number" class="custom-input form-control" aria-label="Username" aria-describedby="basic-addon1" id="monto" name="monto" placeholder="0.00,0" required>
            <div class="invalid-feedback">
                    El monto a cobrar es obligatorio.
             </div>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario (opcional)</label>
            <textarea class="form-control custom-textarea" id="comentario" name="comentario"></textarea>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: rgb(70, 70, 70);">Cerrar</button>
        <button type="button" class="btn text-black" style="background-color: white; "  onclick="abrirSegundoModal()">Siguiente</button>
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
      <div class="modal-body">
        <form id="publicacionFinal" action="GuardarPostulacion.php" method="post">
            
          <div class="input-group mb-3 ">
            <h3> <?php echo $nombre ?> </h3>
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

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: rgb(70, 70, 70);">Cerrar</button>
        <button type="submit" class="btn text-black" style="background-color: white;">Publicar</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="script.js"></script>

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

<!-- JavaScript para abrir el segundo modal -->
<script>
    function abrirSegundoModal() {

       // Obtencion de ID de la publicacion desde el boton 'postularme'
       var idPublicacion = "<?php echo $post['IdPublicacion']; ?>";   
       document.getElementById('idpublicacionconfirmada').value = idPublicacion; 
    
        var formulario = document.getElementById('publicacion');
        if (formulario.checkValidity()) {

        // Variables para obtener los datos del primer modal
        var monto = document.getElementById('monto').value;
        var comentario = document.getElementById('comentario').value;
    
        // Muestra de lo ingresado en el segundo modal
        document.getElementById('montoConfirmado').innerText = '$ ' + monto;
        document.getElementById('comentarioConfirmado').innerText = comentario ? comentario : "No se ha dejado un comentario.";

        // Asignacion de valor a los input ocultos del segundo modal, para pasar los valores al archivo correspondiente
        document.getElementById('montoInput').value = monto;
        document.getElementById('comentarioInput').value = comentario;  

            // Cerrar el primer modal
            var primerModal = bootstrap.Modal.getInstance(document.getElementById('modalpostularse'));
            primerModal.hide();

            // Abrir el segundo modal
            var segundoModal = new bootstrap.Modal(document.getElementById('publicarmodalpostularse'));
            segundoModal.show();
        } else {
            formulario.classList.add('was-validated');
        }
    }
</script>