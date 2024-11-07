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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <title>Verificar Usuario</title>
</head>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include "ConexionBS.php";
include "CrearPublicacion.php";
?>


<body>
    <!-- HEADER -->
    <?php
        include 'header.php';
    ?>
    <!-- CONTENIDO -->
    <div class="contenedor container-fluid">
      <div class="row p-2 pt-3">

        <!-- columna: Usuario -->
        <?php
            include 'sidebarleft.php';
            
        ?>
        <!-- columna: publicaciones -->
        <div class="publicaciones col-lg-6 col-md-" id="conteni">
            
        <?php                

                $ConsultaVerificaciones = "SELECT v.*, u.NombreUsuario, u.ApellidoUsuario
                FROM validaciones v
                INNER JOIN usuarios u ON v.IdUsuarioValidacion = u.IdUsuario 
                WHERE  Estado = 'En revision'
                ORDER BY IdValidacion ASC"; 
                $resultadoPedidos = mysqli_query($conexion, $ConsultaVerificaciones);

                if(mysqli_num_rows($resultadoPedidos) <= 0){
                    $content = false;
                }else{
                while ($row = mysqli_fetch_assoc($resultadoPedidos)) {
                    $content = true;              
                    ?>

                <div class="post card">
                    <div class="card-body">
                        <div class="user d-flex justify-content-start">
                            <?php
                            echo $row['NombreUsuario'] . ' ' . $row['ApellidoUsuario'];
                            ?>
                        </div><br>

                        <div class="postDetails row ms-5">
                            <div class="card-text col-12 col-sm-6">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                DNI: <?php
                                        echo $row['DNIUsuarioValidacion'];
                                    ?> <br>
                            </div>
                            <div class="card-text col-12 col-sm-6">        
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                                CUIL: <?php 
                                        echo $row['CUILUsuarioValidacion'];
                                    ?> <br>
                            </div>
                            <br><br><div class="card-text col-12">
                                    <?php
                                        $archivo = $row['ImagenValidacion'];
                                        $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                            echo '<img src="' . $archivo . '" alt="Archivo de validación" style="max-width: 100%;">';
                                        } elseif ($extension == 'pdf') {
                                            echo '<a href="' . $archivo . '" target="_blank" class="botonpdf">Ver PDF</a>';
                                        }
                                     ?>
                            </div><br><br>
                        </div>
                    </div>

                    <div class="card-footer d-flex">
                        <div class="postBottom text-center txt">
                            <i class="bi bi-clipboard2-check-fill"></i>
                            
                            <form action="ActualizarValidacion.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['IdUsuarioValidacion']; ?>">
                                <input type="hidden" name="accion" value="validar">
                                <button type="submit" class="botonvalidar">Validar Usuario</button>
                            </form>                            
                        </div>
                        <div class="postBottom text-center txt">
                            <i class="bi bi-clipboard2-x-fill"></i> 

                            <form action="ActualizarValidacion.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['IdUsuarioValidacion']; ?>">
                                <input type="hidden" name="accion" value="rechazar">
                                <button type="submit" class="botonnovalidar">Rechazar Usuario</button>
                            </form>
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
            } 
            ?>
            
        </div>

      </div>
     <?php include 'PiedePagina.php'; ?>
    </div>

    <!-- FOOTER MOBILE -->
        <?php
            include 'footermobile.php';
        
        ?>

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
        <?php
        include "DesconexionBS.php";
        ?>
</body>

</html>