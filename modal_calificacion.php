<div class="modal fade" id="calificacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <?php

        include "ConexionBS.php";
        $sql= "SELECT u.NombreUsuario 
        FROM usuarios u 
        JOIN notificaciones n ON u.IdUsuario = n.IdUsuarioCalificar 
        JOIN publicaciones p ON n.IdPublicacion = p.IdPublicacion 
        WHERE n.IdUsuario = ".$_SESSION['idUser'];
        $resultado= mysqli_query($conexion,$sql);

        if (mysqli_num_rows($resultado) > 0) 
        { 
          $row= mysqli_fetch_assoc($resultado);
          echo "<h1 class='modal-title fs-5' id='staticBackdropLabel'>Califica a tu socio ".$row['NombreUsuario']."</h1>";
        }

        ?> 

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">

            <?php
            //VALIDACION DE DATOS Y GUARDAR
              if (isset($_POST['btn'])){
                if (isset($_POST['calificacion'])) {
                  include 'guardarCalificacion.php';
                } else {
                  echo "<p id='feedbackText' class='text-center fw-bold text-danger'>Ingrese una calificación para continuar.</p>";
                }
              }
            ?>

            <div class="rating"> 
              <input type="radio" name="calificacion" value="enojado" id="angry" required> 
              <label for="angry"><i class="fa-solid fa-face-angry"></i></label> 
              <input type="radio" name="calificacion" value="triste" id="sad" required> 
              <label for="sad"><i class="fa-solid fa-face-frown"></i></label> 
              <input type="radio" name="calificacion" value="normal" id="meh" required> 
              <label for="meh"><i class="fa-solid fa-face-meh"></i></label>
              <input type="radio" name="calificacion" value="feliz" id="happy" required> 
              <label for="happy"><i class="fa-solid fa-face-smile"></i></label>
              <input type="radio" name="calificacion" value="muyfeliz" id="sohappy" required> 
              <label for="sohappy"><i class="fa-solid fa-face-laugh-beam"></i></label>
            </div>
            <p id="feedbackText" class="mt-3 text-center fw-bold">¿Qué te pareció el servicio?</p>
            <textarea class="form-control" placeholder="Deja un comentario adicional" id="floatingTextarea2" style="height: 100px"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn" style="background-color:rgb(80, 216, 208);" name="btn" value="enviar">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      const radioButtons = document.querySelectorAll('input[name="calificacion"]');
      const feedbackText = document.getElementById('feedbackText');
        
      radioButtons.forEach(function(radio) {
          radio.addEventListener('change', function() {
              switch (this.value) {
                  case 'enojado':
                      feedbackText.style= 'color:rgb(13, 40, 75)';
                      feedbackText.textContent = "El servicio no me gustó para nada.";
                      break;
                  case 'triste':
                      feedbackText.style= 'color:rgb(7, 64, 113)';
                      feedbackText.textContent = "El servicio no fue muy bueno.";
                      break;
                  case 'normal':
                      feedbackText.style= 'color:rgb(18, 146, 154)';
                      feedbackText.textContent = "El servicio no estuvo ni bien ni mal.";
                      break;
                  case 'feliz':
                      feedbackText.style= 'color:rgb(69, 191, 182)';
                      feedbackText.textContent = "El servicio fue bueno.";
                      break;
                  case 'muyfeliz':
                      feedbackText.style= 'color:rgb(69, 191, 182)';
                      feedbackText.textContent = "¡Me encantó el servicio!";
                      break;
              }
          });
      });
    });
</script>

<?php
include "DesconexionBS.php";
?>