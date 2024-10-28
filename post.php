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
    //include "CrearPublicacion.php";

    include "FormPostularse.php";

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
                //obtener id publicacion
                $idpost = $_GET['id'];
                $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
                FROM publicaciones p
                INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                WHERE p.IdPublicacion = $idpost";

                $consulta = mysqli_query($conexion, $sql);
                $post = mysqli_fetch_assoc($consulta);
                // id del dueño de la publicacion
                $idUserPost = $post['IdUsuario'];
            ?>

            <input type="hidden" id="idUser" value="<?php echo $idusu; ?>">
            <input type="hidden" id="idUserPost" value="<?php echo $idUserPost; ?>">

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
                                <button class="btn btn-sm postLinks" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <!-- *** EL BOTON QUE SE MUESTRA DEPENDE DEL USUARIO ACTIVO -->
                                <?php
                                    if ($idusu == $idUserPost){
                                ?>
                                    <li>
                                        <a href="eliminarPublicacion.php?id=<?php echo $idpost; ?>" class="dropdown-item redLink" id="deleteP">
                                            <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </a>
                                    </li>
                                <?php
                                    }else{
                                ?>
                                    <li>
                                        <a href="" class="dropdown-item redLink">
                                            <i class="fa-regular fa-flag"></i> Denunciar
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>
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
                    <!-- comentarios -->
                    <?php 
                        $sqlC = "SELECT IdMensaje FROM mensajes WHERE IdPublicacionMensaje = $idpost";
                        $contC = mysqli_query($conexion, $sqlC);
                    ?>
                    <div class="text-center cursor" id="btnComments" style="width: 50%;">
                        <i class="fa-solid fa-comments"></i> 
                        <?php echo mysqli_num_rows($contC). ' comentarios'; ?>
                    </div>
                    <!-- postulaciones -->
                    <?php 
                        $sqlP = "SELECT IdPostulacion FROM postulaciones WHERE IdPublicacion = $idpost";
                        $contP = mysqli_query($conexion, $sqlP);
                    ?>
                    <div class="text-center cursor" id="btnPostu" style="width: 50%;">
                        <i class="fa-solid fa-address-card"></i> 
                        <?php echo mysqli_num_rows($contP). ' postulaciones'; ?> 
                    </div>
                </div>

            </div>

            <!-- comentarios y postulaciones -->
            <div id="postBottom mb-4">
            <?php
                include 'comentarios.php'
            ?>
            <?php
                include 'postulaciones.php'
            ?>
            </div>
            
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



<script src="script.js"></script>

<!-- JavaScript para abrir el segundo modal -->
<script>
    function abrirSegundoModal() {

       // Obtencion de ID de la publicacion desde el boton 'postularme'
       var idPublicacion = "<?php echo $idpost; ?>";   
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