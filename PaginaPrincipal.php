<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>Inicio</title>
</head>

<?php
session_start();
include "ConexionBS.php";

// Obtener el ID del usuario desde la sesión
// $usuario_id = $_SESSION['idUser'];

// Realizar la consulta para obtener la imagen del usuario
// $sql = "SELECT ImagenUsuario FROM usuarios WHERE IdUsuario = '$usuario_id'";
// $result = mysqli_query($conexion, $sql);

// if ($result->num_rows > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $imagen = $row['ImagenUsuario'];
// } else {
//     $imagen = 'ruta/imagen/default.jpg'; // Imagen por defecto si no se encuentra el usuario
// }

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
        
        <!-- columna: publicaciones -->
        <div class="publicaciones col-lg-6 col-md-">
            
        <?php
            $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
            FROM publicaciones p
            INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario 
            ORDER BY p.IdPublicacion DESC";
            $publicaciones = mysqli_query($conexion, $sql);
            $content = false;

            while ($row = mysqli_fetch_assoc($publicaciones)) {
                $content = true;
                ?>

                <div class="post card">
                    <div class="card-body">
                        <div class="user d-flex justify-content-start">
                            <img class="postUserImg rounded-circle me-2" src="<?php echo $row['ImagenUsuario']; ?>">
                            <?php
                            echo $row['NombreUsuario']. " " . $row['ApellidoUsuario'];
                            ?>
                        </div>

                        <div class="postDetails ms-5">
                            <h6 class="card-title"><?php echo $row['Titulo']; ?></h6>
                            <div class="card-text">
                                <i class="i fa-solid fa-location-dot"></i>
                                Origen: <?php
                                        echo $row['ProvinciaOrigen'].", ".$row['LocalidadOrigen'].", ".$row['BarrioOrigen'];
                                    ?> <br>
                                <i class="i fa-solid fa-route"></i>
                                Destino: <?php 
                                        echo $row['ProvinciaDestino'].", ".$row['LocalidadDestino'].", ".$row['BarrioDestino'];
                                    ?> <br>
                                <i class="fa-solid fa-calendar-days"></i>
                                Fecha límite para completar entrega: <?php echo $row['FechaLimite'];?> <br>
                                <i class="i fa-solid fa-ruler"></i>
                                Volumen: <?php 
                                    echo $row['Largo'].' x '.$row['Ancho'].' x '.$row['Alto'];
                                    ?> <br>
                                <i class="i fa-solid fa-weight-scale"></i>
                                Peso: <?php echo $row['Peso']. 'g <br>';
                                if ($row['Fragil'] == 'sí') { ?>
                                    <span class="txt redLink">FRAGIL</span><br>
                                    <?php
                                }

                                echo $row['Descripcion'];
                                ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center me-3">
                            <a href="post.php?id=<?php $idpost=$row['IdPublicacion']; echo urlencode($idpost); ?>" class="link stretched-link">
                                Ver más <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="postBottom text-center txt">
                            <i class="fa-solid fa-comments"></i>
                            <?php 
                            $sql = "SELECT IdMensaje FROM mensajes WHERE IdPublicacionMensaje = $idpost";
                            $contC = mysqli_query($conexion, $sql);
                            echo mysqli_num_rows($contC). ' comentarios';
                            ?>
                        </div>
                        <div class="postBottom text-center txt">
                            <i class="fa-solid fa-address-card"></i> 0 postulaciones
                        </div>
                    </div>
                </div>

                <?php
            } //aca se termina el while
                
            if (!$content) { ?>

                <div class="text-center pt-5">
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="imgMensaje" width="30%" src="img/cajas.png"
                            alt="Imagen de gstudioimagen1 en Freepik">
                    </div>
                    <p>Parece que aquí no hay nada... por ahora</p>
                </div>

                <?php
            } //aca se termina el if
            ?>
            
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
    
       <!-- Modal para publicar -->
       <div class="modal fade" id="publicarmodal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="publishModalLabel">Publicar necesidad de envio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="publicacion" action="guardarPublicacion.php" method="post" class="needs-validation" novalidate>
                
            <div class="mb-3">
                <label for="tituloPubli" class="form-label">Título de la publicación*</label>
                <input type="text" class="form-control" id="tituloPubli" name="tituloPubli" placeholder="Título" required>
                <div class="invalid-feedback">
                    El título de la publicación es obligatorio.
                </div>
            </div>

            <div class="mb-3">
                <label for="origenPubli" class="form-label"><i class="fa-solid fa-location-dot"></i> Desde</label><br>

                <div class="row">
                    <div class="col-md-6">
                        <label for="provinciaorigen" class="form-label"> Provincia</label>
                        <input type="text" class="form-control" id="provinciaorigen" name="provinciaorigen" placeholder="Provincia" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la provincia de origen.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="Localidadorigen" class="form-label">Localidad</label>
                        <input type="text" class="form-control" id="Localidadorigen" name="Localidadorigen" placeholder="Localidad" required>  
                        <div class="invalid-feedback">
                            Por favor, ingrese la localidad de origen.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="barrioorigen" class="form-label"> Barrio</label>
                        <input type="text" class="form-control" id="barrioorigen" name="barrioorigen" placeholder="Barrio" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el barrio de origen.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="direccionorigen" class="form-label"> Dirección</label>
                        <input type="text" class="form-control" id="direccionorigen" name="direccionorigen" placeholder="Dirección de calle" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la dirección de origen.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="destinoPubli" class="form-label"><i class="fa-solid fa-location-dot"></i> Hasta</label><br>

                <div class="row">
                    <div class="col-md-6">
                        <label for="provinciadestino" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="provinciadestino" name="provinciadestino" placeholder="Provincia" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la provincia de destino.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="Localidaddestino" class="form-label"> Localidad</label>
                        <input type="text" class="form-control" id="Localidaddestino" name="Localidaddestino" placeholder="Localidad" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la localidad de destino.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="barriodestino" class="form-label"> Barrio</label>
                        <input type="text" class="form-control" id="barriodestino" name="barriodestino" placeholder="Barrio" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el barrio de destino.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="direcciondestino" class="form-label"> Dirección</label>
                        <input type="text" class="form-control" id="direcciondestino" name="direcciondestino" placeholder="Dirección de calle" required>    
                        <div class="invalid-feedback">
                            Por favor, ingrese la dirección de destino.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="fechaLimite" class="form-label">Fecha Limite</label>
                <input type="date" class="form-control" id="fechaLimite" name="fechaLimite" placeholder="Fecha" required>
                <div class="invalid-feedback">
                    Por favor, ingrese una fecha límite.
                </div>
            </div>

        <div class="mb-3">
            <label for="medidas" class="form-label"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Medidas del paquete</label>
            <div class="row">
                <div class="col-6">
                    <input type="number" class="form-control" id="alto" name="alto" placeholder="Alto (cm)" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la altura del paquete.
                    </div>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" id="ancho" name="ancho" placeholder="Ancho (cm)" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el ancho del paquete.
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <input type="number" class="form-control" id="largo" name="largo" placeholder="Largo (cm)" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el largo del paquete.
                    </div>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" id="peso" name="peso" placeholder="Peso (gr)" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el peso del paquete.
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">¿Es frágil?</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fragil" id="fragilSi" value="sí" required>
                    <label class="form-check-label" for="fragilSi">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fragil" id="fragilNo" value="no" required>
                    <label class="form-check-label" for="fragilNo">No</label>
                </div>
                <div class="invalid-feedback">
                    Por favor, seleccione si el paquete es frágil.
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            <div class="invalid-feedback">
                Por favor, ingrese una descripción.
            </div>
        </div><hr>
        <div class="mb-3">
        <label for="descripcion" class="form-label"><h5>Datos del remitente</h5></label>
        </div>
        <div class="mb-3">
            <label for="nombreremitente" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreremitente" name="nombreremitente" placeholder="Nombre del remitente" required>
            <div class="invalid-feedback">
                Por favor, ingrese un nombre.
            </div>
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Número de celular</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular" required>
            <div class="invalid-feedback">
                Por favor, ingrese un número de celular.
            </div>
        </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="publicacion" class="btn text-white" style="background-color: rgb(18, 146, 154);">Publicar</button>
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

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <?php
        include "DesconexionBS.php";
        ?>
</body>

</html>