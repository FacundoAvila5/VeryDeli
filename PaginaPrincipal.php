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
include "CrearPublicacion.php";

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
                            $sqlC = "SELECT IdMensaje FROM mensajes WHERE IdPublicacionMensaje = $idpost";
                            $contC = mysqli_query($conexion, $sqlC);
                            echo mysqli_num_rows($contC). ' comentarios';
                            ?>
                        </div>
                        <div class="postBottom text-center txt">
                            <i class="fa-solid fa-address-card"></i> 
                            <?php 
                            $sqlP = "SELECT IdPostulacion FROM postulaciones WHERE IdPublicacion = $idpost";
                            $contP = mysqli_query($conexion, $sqlP);
                            echo mysqli_num_rows($contP). ' postulaciones';
                        ?>
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
        <div class="col-lg-3 col-md-3 col-3 d-none d-lg-block">
            <?php
                include 'sidebarright.php'
            ?>
        </div>
      </div>

    </div>

    <!-- FOOTER MOBILE -->
        <?php
            include 'footermobile.php'
        ?>

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