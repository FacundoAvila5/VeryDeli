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
$usuario_id = $_SESSION['idUser'];

// Realizar la consulta para obtener la imagen del usuario
$sql = "SELECT ImagenUsuario FROM usuarios WHERE IdUsuario = '$usuario_id'";
$result = $conexion->query($sql);

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    // Obtener la fila resultante como un arreglo asociativo
    $row = $result->fetch_assoc();
    $imagen = $row['ImagenUsuario'];
} else {
    $imagen = 'ruta/imagen/default.jpg'; // Imagen por defecto si no se encuentra el usuario
}
?>


<body>

    <!-- NAV -->
    <nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">
            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="PaginaPrincipal.php">
                    <img id="logo" src="logos/logo-negro.svg">
                </a>
            </div>
            <!-- searchbar -->
            <div class=" d-flex search-box">
                <div class="form-container input-group search-bar">
                    <!-- <form class="d-flex" role="search"> -->
                    <input class="form-control" type="search" placeholder="Busca una publicación" aria-label="Search">
                    <button class="btn btn-search" type="submit">
                        <i class="lupa fa-solid fa-magnifying-glass"></i>
                    </button>
                    <!-- </form> -->
                </div>
            </div>

            <div class="col-2">
                <!-- div vacio para centrar. aca podría ir la ubicacion/direccion/etc -->
            </div>

        </div>
    </nav>
    <!-- CONTENIDO -->
    <div class="contenedor container-fluid">
      <div class="row p-2 pt-3">

        <!-- columna: user -->
        <div class="col-lg-3 d-none d-lg-block">
            <!-- info -->
            <a href="perfildeusuario.php" class="link">
                <div class="user d-flex justify-content-start p-2">
                    <img class="userImg rounded-circle me-2" src="<?php echo $imagen; ?>" alt="">
                    <?php
                        $nombre = $_SESSION['usuario'];
                        echo $nombre;
                    ?>
                </div>
            </a>
            <!-- botones justify-content-end-->
            <div class="userBtn d-flex ms-5">
                <!-- publicar -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link" data-bs-toggle="modal" data-bs-target="#publicarmodal"><i class="fa-solid fa-pen-to-square"></i> Publicar</a>
                        <!-- <button class="btn btn-small btn-publi"><i class="fa-solid fa-pen-to-square"></i> Publicar</button> -->
                    </div>
                </div>
                <!-- vehiculos -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="perfildeusuario.php#misVehiculos" class="link"><i class="fa-solid fa-car"></i> Mis vehículos</a>
                    </div>
                </div>
                <!-- actividad -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-clock-rotate-left"></i> Actividad</a>
                    </div>
                </div>
                <!-- verif -->
                <div class="row">
                    <div class="col">
                        <a href="perfildeusuario.php#verificarCuenta" class="link"><i class="fa-solid fa-user-check"></i> Verificar mi cuenta</a>
                    </div>
                </div>
                <hr>
                <!-- cerrar sesion -->
                <div class="row">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
                    </div>
                </div>
            </div>

        </div>
 
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
                            <h6 class="card-title"><?php $titulo = $row['Titulo']; echo $titulo; ?></h6>
                            <div class="card-text">
                                <i class="i fa-solid fa-location-dot"></i>
                                Origen: <?php
                                        $prov = $row['ProvinciaOrigen']; $localidad = $row['LocalidadOrigen']; $barrio = $row['BarrioOrigen'];
                                        echo $prov .",". $localidad  .",". $barrio;
                                        // printf("%s, %s, %s", $row['ProvinciaOrigen'], $row['LocalidadOrigen'], $row['BarrioOrigen']); 
                                    ?> <br>
                                <i class="i fa-solid fa-route"></i>
                                Destino: <?php 
                                        $prov = $row['ProvinciaDestino']; $localidad = $row['LocalidadDestino']; $barrio = $row['BarrioDestino'];
                                        echo $prov .",". $localidad  .",". $barrio;
                                    ?> <br>
                                <i class="fa-solid fa-calendar-days"></i>
                                Fecha límite para completar entrega: <?php $date = $row['FechaLimite']; echo $date; ?> <br>
                                <i class="i fa-solid fa-ruler"></i>
                                Volumen: <?php 
                                    $largo = $row['Largo']; $ancho = $row['Ancho']; $alto = $row['Alto'];
                                    echo $largo .' x '. $ancho .' x '. $alto;
                                    // printf("%f x %f x %f", $row['Largo'], $row['Ancho'], $row['Alto']); 
                                    ?> <br>
                                <i class="i fa-solid fa-weight-scale"></i>
                                Peso: <?php $peso=$row['Peso']; echo $peso. 'g <br>';
                                if ($row['Fragil'] == 'sí') { ?>
                                    <span class="txt redLink">FRAGIL</span><br>
                                    <?php
                                }

                                $desc = $row['Descripcion']; echo $desc;
                                ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center me-3">
                            <a href="post.php?id=<?php echo urlencode($row['IdPublicacion']); ?>" class="link stretched-link">
                                Ver más <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="postBottom text-center txt">
                            <i class="fa-solid fa-comments"></i> 0 comentarios
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

        <!-- columna: notificaciones -->
        <div class="col-lg-3 col-md-3 col-3 d-none d-lg-block">
            <p class="txt">Notificaciones</p>

            <div class="row">
                <div class="notificaciones col rounded" style="padding: 5px;">
                    <div class="notif bg-white rounded text-center">
                        notif
                    </div>
                    <div class="notif bg-white rounded text-center">
                        notif
                    </div>
                </div>
            </div>
        </div>

      </div>

    </div>

    <!-- BOTTOM NAV -->
    <div class="bNav container-fluid bg-body-tertiary d-block d-lg-none">
      <div class="bNavIcons d-flex">
        <!-- home -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-solid fa-house"></i></a>
        </div>
        <!-- busqueda -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
        <!-- postear -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-regular fa-square-plus"></i></a>
        </div>
        <!-- notifs -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-regular fa-bell"></i></a>
        </div>
        <!-- perfil -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-regular fa-user"></i></a>
        </div>
      </div>
    </div>    
    
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