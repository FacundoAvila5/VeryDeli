<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- estilos -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">

        <title>Inicio</title>
</head>

<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$alert_message = $_SESSION['alert_message'] ?? '';
unset($_SESSION['alert_message']); 

include "ConexionBS.php";
include "CrearPublicacion.php";


?>

<!-- Alerta de Bootstrap en el centro de la pantalla -->
<?php if ($alert_message): ?>
    <div id="alert-box" class="alert alert-info alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
        <strong>¡Éxito! </strong> <?php echo $alert_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<body>
    <!-- HEADER -->
    <?php
        include 'header.php';
    ?>

    <!-- CONTENIDO -->
    <div class="contenedor container-fluid">
      <div class="row p-2 pt-3" id="contenido-principal">

        <!-- columna: Usuario -->
        <?php
            include 'sidebarleft.php';
            
        ?>

        
        <!-- columna: publicaciones -->
        <div class="publicaciones col-lg-6 d-lg-block" id="conteni">
        <?php
            include "BusquedasMobile.php";
            $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
            FROM publicaciones p
            INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario 
            ORDER BY p.IdPublicacion DESC";
            $publicaciones = mysqli_query($conexion, $sql);
            $content = true;

            if(isset($_SESSION['resultadoBusqueda'])){
                if(!empty($_SESSION['resultadoBusqueda'])){  
                $publicaciones = '';               
                $publicaciones = $_SESSION['resultadoBusqueda'];
                $content = true;
                }
                else if((empty($_SESSION['resultadoBusqueda']))){
                    $content = false;
                }
                else{
                    while ($row = mysqli_fetch_assoc($publicaciones)) {
                        $publicaciones[] = $row;
                        $content = true;
                    }
                }
             }   
            if ($content) {
                foreach ($publicaciones as $row){
                    $content = true;
                    $isInactive = $row['Estado'] == "Inactiva";
                ?>

                <div class="card card-border post <?php echo $isInactive ? 'inactive' : ''; ?>">
                    <div class="card-body">
                        <div class="row user ms-0">
                            <div class="col p-0">
                                <img class="postUserImg rounded-circle me-2" src="<?php echo $row['ImagenUsuario']; ?>">
                                <span class="txt"><?php echo $row['NombreUsuario']. " " . $row['ApellidoUsuario']. " "?></span>
                                <?php
                                    if ($row['Validado'] == 1) {
                                        echo ' <i class="bi bi-patch-check-fill align-self-center user-check"></i>';      
                                }
                                    if ($row['Estado'] == "Inactiva") {
                                ?>
                                    <span class="badge" style="background-color: rgb(18, 146, 154);">Publicación finalizada</span>
                                <?php
                                    } 
                                ?>
                            </div>
                            <!-- admin: icono publicacion denunciada -->
                            <?php
                                if ($_SESSION['idUser']=='1') { //Si el usuario es admin !!! CORREGIR TIPO !!!
                                    
                                    $sql2= "SELECT IdPublicacion FROM denuncias WHERE IdPublicacion = '".$row['IdPublicacion']."' ";
                                    $result= mysqli_query($conexion,$sql2);

                                    if (mysqli_num_rows($result) > 0) { //Si hay denuncias en el post
                                        echo "<div class='col-1'> 
                                            <i class='fa-solid fa-triangle-exclamation' style='color:red;' title='Publicacion denunciada'></i> 
                                        </div>";
                                    }
                                }
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
                                Fecha límite para completar la entrega: <?php echo $row['FechaLimite'];?> <br>
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
                            <a href="post.php?id=<?php $idpost=$row['IdPublicacion']; echo urlencode($idpost); ?>" class="link stretched-link"
                            style="color: rgb(18, 145, 154);">
                                Ver más <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <div class="card-footer card-border d-flex">
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
                }
            } 
                
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

     <?php include 'PiedePagina.php'; ?>
    </div>

    <!-- FOOTER MOBILE -->
        <?php
            include 'footermobile.php';
        
        ?>

    <script>
        function limpiaDivParaBusqueda(){
        window.onload = function() {
            document.getElementById('conteni').innerHTML = ''; 
        };
    }
    </script>

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>

        <?php
        include "DesconexionBS.php";
        ?>
</body>

</html>