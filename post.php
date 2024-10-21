<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">

        <title>Publicación</title>
</head>

<?php
    session_start();
    include "ConexionBS.php";
    include "CrearPublicacion.php";
    $nombre = $_SESSION['usuario']; 
    $idusu =  $_SESSION['idUser'];
?>

<body>
    <!-- HEADER -->
    <?php
    include 'header.php'
    ?>

    <!-- CONTENIDO -->
    <div class="contenedor container-fluid">
      <div class="row p-2 pt-3">

        <!-- columna: Usuario -->
        <?php
            include 'sidebarleft.php'
        ?>

        <!-- publicaciones -->
        <div class="publicaciones col-lg-6 col-md-">
            <?php
                $id = $_GET['id'];
                $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
                FROM publicaciones p
                INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                WHERE p.IdPublicacion = $id";

                $consulta = mysqli_query($conexion, $sql);
                $post = mysqli_fetch_assoc($consulta);
            ?>

            <div class="post card">
                <div class="card-header bg-transparent" style="padding: 3px;">
                    <div class="row" style="margin: auto;">
                        <!-- volver -->
                        <div class="col p-0">
                            <div class="d-flex ">
                                <div class="btnVolver rounded d-flex justify-content-center align-items-center">
                                    <a class="link" href="PaginaPrincipal.php"><i class="fa-solid fa-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="row" style="margin: auto;">
                        <!-- USER INFO -->
                        <div class="user col-10 p-0">
                            <img class="postUserImg rounded-circle me-2" src="<?php echo $post['ImagenUsuario']; ?>">
                            <?php
                                echo '<span class="txt">'.$post['NombreUsuario']. " " . $post['ApellidoUsuario'].'</span>';
                            ?>
                        </div>
                        <!-- POST LINKS -->
                        <div class="col p-0 d-flex justify-content-end">
                            <div class="btn-group dropstart">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <!-- *** EL BOTON QUE SE MUESTRA DEPENDE DEL USUARIO ACTIVO -->
                                    <li>
                                        <a href="" class="dropdown-item redLink"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item redLink"><i class="fa-regular fa-flag"></i> Denunciar</a>
                                    </li>
                                </ul>
                            </div>  
                        </div>  
                    </div>

                    <div class="row">
                        <div class="postDetails ms-5 col">
                            <h6 class="card-title"><?php echo $post['Titulo']; ?></h6>
                                <i class="fa-solid fa-location-dot"></i> 
                                Origen: <?php
                                        echo $post['ProvinciaOrigen'].", ".$post['LocalidadOrigen'].", ".$post['BarrioOrigen'];
                                    ?> <br>
                                <i class="fa-solid fa-route"></i> 
                                Destino: <?php 
                                        echo $post['ProvinciaDestino'].", ".$post['LocalidadDestino'].", ".$post['BarrioDestino'];
                                    ?> <br>
                                <i class="fa-solid fa-calendar-days"></i>
                                Fecha límite para completar entrega: <?php echo $post['FechaLimite'];?> <br>
                                <i class="fa-solid fa-ruler"></i> Volumen <br>
                                Longitud: <?php echo $post['Largo']. ' cm'?> <br>
                                Ancho: <?php echo $post['Ancho']. ' cm'?> <br>
                                Alto: <?php echo $post['Alto']. ' cm'?> <br>
                                <i class="fa-solid fa-weight-scale"></i> Peso: <?php echo $post['Peso']. ' g <br><br>';
                            
                                echo $post['Descripcion'];
                                ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center me-3">
                        <button class="btn btn-light link" data-bs-toggle="modal" data-bs-target="#modalpostularse">Postularme</button>
                    </div>
                </div>

                <div class="card-footer d-flex">
                    <div class="text-center" style="width: 50%;">
                        <i class="fa-solid fa-comments"></i> 0 comentarios
                    </div>
                    <div class="text-center" style="width: 50%;">
                        <i class="fa-solid fa-address-card"></i> 0 postulaciones
                    </div>
                </div>

            </div>

            <!-- comentarios -->
            <div class="comentarios">
                <!-- *** PREGUNTA = no es dueño de la publi -->
                <div class="comment bg-white">
                    <div class="row p-2 mb-3">
                        <div class="col-1 d-flex justify-content-start">
                            <img class="postUserImg rounded-circle" src="img/2.jpg">
                        </div>
                        <div class="col-11 d-flex align-items-center">
                            <input type="text" class="cInput form-control" placeholder="Escribe aquí tu pregunta"></input>
                            <button class="btn"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
                <!-- *** PREGUNTA YA PUBLICADA -->
                <div class="comment bg-white">
                    <div class="row p-2 mb-3">
                        <div class="col-1 d-flex justify-content-start">
                            <img class="postUserImg rounded-circle" src="img/2.jpg">
                        </div>
                        <div class="col-11 d-flex align-items-center">
                            ¿Soy una pregunta?
                        </div>
                    </div>
                </div>
                <!-- *** RESPUESTA = si es dueño de la publi -->
                <div class="respuesta row mb-3">
                    <div class="col-1"></div>
                    <div class="col">
                        <div class="comment bg-white">
                            <div class="row p-2">
                                <!-- <div class="col-1"></div> -->
                                <div class="col-1 d-flex justify-content-start">
                                    <img class="postUserImg rounded-circle" src="img/1.jpg">
                                </div>
                                <div class="col-11 d-flex align-items-center">
                                    <input type="text" class="cInput form-control" placeholder="Escribe aquí tu respuesta"></input>
                                    <button class="btn"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>

        <!-- columna: Notificaciones -->
        <?php
            include 'sidebarright.php'
        ?>

      </div>

    </div>

    <!-- FOOTER MOBILE -->
        <?php
            include 'footermobile.php'
        ?>    


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

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>   
   <?php
        include "DesconexionBS.php";
    ?>
</body>

</html>