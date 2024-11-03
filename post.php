<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">

        <title>Publicación</title>
</head>

<?php
    session_start();
    include "ConexionBS.php";
    // include "CrearPublicacion.php";
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

                $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
                FROM publicaciones p
                INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                WHERE p.IdPublicacion = $idpost";

                $consulta = mysqli_query($conexion, $sql);
                $post = mysqli_fetch_assoc($consulta);

                // id del dueño de la publicacion
                $idUserPost = $post['IdUsuario'];

                //revisa si hay un postulante ya seleccionado
                $postulanteElegido = false;
                if($post['IdPostulante'] != 0)
                    $postulanteElegido = true;

                $dueñoPost = false;
                if ($idusu == $idUserPost)
                    $dueñoPost = true;

            ?>

            <input type="hidden" id="idUser" value="<?php echo $idusu; ?>">
            <input type="hidden" id="idUserPost" value="<?php echo $idUserPost; ?>">

            <div class="card card-border post">
                <div class="card-header card-border bg-transparent" style="padding: 3px;">
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

                    <!-- Visualizacion de la denuncia para el admin -->
                    <?php
                        include 'postdenuncia_admin.php';
                    ?>

                </div>
                <div class="card-content">
                    <div class="row" style="margin: auto;">
                        <!-- USER INFO -->
                        <div class="col-10 p-0">
                            <img class="postUserImg rounded-circle me-2" src="<?php echo $post['ImagenUsuario']; ?>">
                            <span class="txt"><?php echo $post['NombreUsuario']. " " . $post['ApellidoUsuario']. " "?></span>
                            <?php
                                if ($post['Validado'] == 1) {
                                    echo ' <i class="bi bi-patch-check-fill align-self-center user-check"></i>';      
                                }
                                if($postulanteElegido){
                            ?>
                                    <span class="badge text-bg-secondary">Publicación pausada</span>
                            <?php
                                }
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
                                    if($dueñoPost){
                                ?>
                                    <!-- <li>
                                        <a href="" id="editP" class="dropdown-item" data-bs-toggle="modal" data-bs-target="">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </a>
                                    </li>  -->
                                    <li>
                                        <a href="" class="dropdown-item redLink" data-bs-toggle="modal" data-bs-target="#modalDeletePost">
                                            <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </a>
                                    </li>                          
                                <?php
                                    }else{
                                ?>
                                    <li>
                                        <a href="#" class="dropdown-item redLink" onclick="abrirModalDenuncia(); return false;">
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
                                        ?><span class="postExtraInfo d-none">, 
                                            <span class="txtExtraInfo"><?php echo $post['DireccionOrigen']; ?></span>
                                        </span>
                                <br>
                                <i class="fa-solid fa-route"></i> 
                                Destino: <?php
                                        echo $post['ProvinciaDestino'].", ".$post['LocalidadDestino'].", ".$post['BarrioDestino'];
                                        ?><span class="postExtraInfo d-none">, 
                                            <span class="txtExtraInfo"><?php echo $post['DireccionDestino']; ?></span>
                                        </span>
                                <br>
                                <i class="fa-solid fa-calendar-days"></i>
                                Fecha límite para completar la entrega: <?php echo $post['FechaLimite'];?> <br>
                                <i class="fa-solid fa-ruler"></i> Volumen <br>
                                Longitud: <?php echo $post['Largo']. ' cm'?> <br>
                                Ancho: <?php echo $post['Ancho']. ' cm'?> <br>
                                Alto: <?php echo $post['Alto']. ' cm'?> <br>
                                <i class="fa-solid fa-weight-scale"></i> Peso: <?php echo $post['Peso']. ' g <br>';
                                echo $post['Descripcion'];
                                ?>
                                 
                                <div class="postExtraInfo d-none">
                                    <h6 class="card-subtitle mb-1 mt-2 text-body-secondary">Información del remitente</h6>
                                    <span class="txtExtraInfo"><i class="fa-solid fa-user"></i> Nombre: <?php echo $post['NombreRemitente']; ?></span> <br>
                                    <span class="txtExtraInfo"><i class="fa-solid fa-phone"></i> Teléfono: <?php echo $post['TelefonoRemitente']; ?></span> <br>
                                </div>
                        </div>
                    </div>
                    
                    <!-- BOTON POSTULACION -->
                    <?php
                        if(!$dueñoPost && !$postulanteElegido){
                    ?>
                    <div class="d-flex justify-content-end align-items-center me-3">
                        <button class="btn btn-deli link" data-bs-toggle="modal" data-bs-target="#modalpostularse">
                            <span class="txt">Postularme</span>
                        </button>
                    </div>
                    <?php
                        }
                    ?>
                </div>

                <div class="card-footer card-border d-flex">
                    <!-- numero comentarios -->
                    <?php 
                        $sqlC = "SELECT IdMensaje FROM mensajes WHERE IdPublicacionMensaje = $idpost";
                        $contC = mysqli_query($conexion, $sqlC);
                    ?>
                    <div class="text-center " id="btnComments" style="width: 50%;">
                        <a class="btn boton" role="button" aria-disabled="true">
                            <i class="fa-solid fa-comments"></i> 
                            <?php echo mysqli_num_rows($contC). ' comentarios'; ?>
                        </a>
                        
                    </div>
                    <!-- numero postulaciones -->
                    <?php 
                        $sqlP = "SELECT IdPostulacion FROM postulaciones WHERE IdPublicacion = $idpost";
                        $consultaP = mysqli_query($conexion, $sqlP);
                        $cantP = mysqli_num_rows($consultaP);
                    ?>
                    <div class="text-center" id="btnPostu" style="width: 50%;">
                        <?php
                            if($dueñoPost && $cantP > 0){
                                if($postulanteElegido){
                        ?>
                                <a class="btn boton" id="linkBtnPostu" role="button" aria-disabled="true" style="color: rgb(7, 64, 113);">
                                    <i class="fa-solid fa-address-card"></i> Postulante
                                </a>
                        <?php
                                }else{
                        ?>
                                <a class="btn boton" id="linkBtnPostu" role="button" aria-disabled="true">
                                    <i class="fa-solid fa-address-card"></i> 
                                    <?php echo $cantP. ' postulaciones'; ?>
                                </a>  
                        <?php
                                }
                            }else{
                        ?>
                        <a class="btn boton disabled" id="linkBtnPostu" role="button" aria-disabled="true">
                            <i class="fa-solid fa-address-card"></i> 
                            <?php echo $cantP. ' postulaciones'; ?>
                        </a> 
                        <?php
                            }
                        ?>
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

<!-- Modal eliminar post -->
<div class="modal fade" id="modalDeletePost" tabindex="-1" aria-labelledby="modalDeletePost" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">¿Eliminar publicación?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modalDeletePost-body text-body-secondary">
                Esta acción es irreversible.
            </div>
            <div class="modal-footer modalDeletePost-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="eliminarPublicacion.php?id=<?php echo $idpost; ?>" id="deleteP" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Denuncia -->
<?php 
    include 'modaldenuncia.php';
?>
<!-- Script para abrir modal denuncia -->
 <script>
    function abrirModalDenuncia() {
        var ModalD = new bootstrap.Modal(document.getElementById('ModalDenuncia'), {});
        ModalD.show();
    }
 </script>

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

    <script src="script.js"></script>
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