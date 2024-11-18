<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/icons/loguito-fondoAzulV2.ico" type="image/x-icon">
    <title>Inicio</title>
</head>
<body>

<div class="container mt-5 w-50">
  <div class="card">
    <div class="card-header">
      <?php
      include "ConexionBS.php";
      $idNotificacion = $_GET['IdNotificacion'] ?? null;
      $idUsuarioCalificar = $_GET['IdUsuarioCalificar'] ?? null;

      $sql= "SELECT NombreUsuario 
             FROM usuarios
             WHERE IdUsuario = '$idUsuarioCalificar'";
      $resultado = mysqli_query($conexion, $sql);

      if (mysqli_num_rows($resultado) > 0) { 
          $row = mysqli_fetch_assoc($resultado);
          echo "<h5 class='card-title'>Califica a tu socio ".$row['NombreUsuario']."</h5>";
      }
      ?>
    </div>
    
    <form action="" method="post">
      <div class="card-body">
          <?php
          if (isset($_POST['btn'])) {
              if (isset($_POST['calificacion'])) {
                  include 'guardarCalificacion.php';
              } else {
                  echo "<p id='feedbackText' class='text-center fw-bold text-danger'>Ingrese una calificación para continuar.</p>";
              }
          }
          ?>

          <div class="rating d-flex justify-content-center my-3"> 
            <input type="radio" name="calificacion" value="enojado" id="angry" required hidden> 
            <label for="angry"><i class="fa-solid fa-face-angry"></i></label> 
            <input type="radio" name="calificacion" value="triste" id="sad" required hidden> 
            <label for="sad"><i class="fa-solid fa-face-frown"></i></label> 
            <input type="radio" name="calificacion" value="normal" id="meh" required hidden> 
            <label for="meh"><i class="fa-solid fa-face-meh"></i></label>
            <input type="radio" name="calificacion" value="feliz" id="happy" required hidden> 
            <label for="happy"><i class="fa-solid fa-face-smile"></i></label>
            <input type="radio" name="calificacion" value="muyfeliz" id="sohappy" required hidden> 
            <label for="sohappy"><i class="fa-solid fa-face-laugh-beam"></i></label>
          </div>

          <p id="feedbackText" class="mt-3 text-center fw-bold">¿Qué te pareció el servicio?</p>
          <textarea class="form-control" placeholder="Deja un comentario adicional" id="floatingTextarea2" name="comentario" style="height: 100px"></textarea>

          <!-- Hidden field to pass the notification ID -->
          <input type="hidden" name="idNotificacion" value="<?php echo $idNotificacion; ?>" />
      </div>
      
      <div class="card-footer text-end">
        <button type="submit" class="btn" style="background-color:rgb(80, 216, 208);" name="btn" value="enviar">Enviar</button>
      </div>
    </form>
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
                      feedbackText.style.color = 'rgb(13, 40, 75)';
                      feedbackText.textContent = "El servicio no me gustó para nada.";
                      break;
                  case 'triste':
                      feedbackText.style.color = 'rgb(7, 64, 113)';
                      feedbackText.textContent = "El servicio no fue muy bueno.";
                      break;
                  case 'normal':
                      feedbackText.style.color = 'rgb(18, 146, 154)';
                      feedbackText.textContent = "El servicio no estuvo ni bien ni mal.";
                      break;
                  case 'feliz':
                      feedbackText.style.color = 'rgb(69, 191, 182)';
                      feedbackText.textContent = "El servicio fue bueno.";
                      break;
                  case 'muyfeliz':
                      feedbackText.style.color = 'rgb(69, 191, 182)';
                      feedbackText.textContent = "¡Me encantó el servicio!";
                      break;
              }
          });
      });
    });
</script>

<script src="https://kit.fontawesome.com/51d2388034.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
include "DesconexionBS.php";
?>
