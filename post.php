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
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
    include "ConexionBS.php";
    include "FormPostularse.php";

    $nombre = $_SESSION['usuario']; 
    $idusu =  $_SESSION['idUser'];
    $idpost = $_GET['id'];
?>

<body>
    <!-- HEADER -->
    <?php
        include 'MensajeExito.php';
        include 'header.php';
    ?>

    <!-- CONTENIDO -->
    <div class="contenedor container-fluid" id="colPost">

      <div class="row p-2 pt-3">

        <!-- columna: Usuario -->
        <?php
            include 'sidebarleft.php'
        ?>

        <!-- publicaciones -->
        <div class="publicaciones col-lg-6 col-md-">
            <?php
                $sql = "SELECT IdUsuarioPostulacion
                FROM postulaciones
                WHERE IdPublicacion = $idpost";
                $queryPostulantes = mysqli_query($conexion, $sql);

                $isPostulado = false ;
                //verifica que el usuario aun no se haya postulado
                while($postulantes = mysqli_fetch_assoc($queryPostulantes)){
                    ($postulantes['IdUsuarioPostulacion'] == $idusu) ? $isPostulado = true : "" ; 
                }
                

                $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
                FROM publicaciones p
                INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                WHERE p.IdPublicacion = $idpost";

                $consulta = mysqli_query($conexion, $sql);
                $post = mysqli_fetch_assoc($consulta);


                // id del dueño de la publicacion
                $idUserPost = $post['IdUsuario'];

                //calcula el promedio del dueño de la publicacion
                include 'calcular_prom.php';
                $promedio = calcularPromedio($idUserPost);

                // revisa si el usuario en sesion es el dueño del post
                $dueñoPost = false;
                if ($idusu == $idUserPost)
                    $dueñoPost = true;


                //id postulante
                $postulanteElegido = $post['IdPostulante'];

                //revisa si el postulante es el usuario en sesion
                $postulanteActivo = false;
                if($post['IdPostulante'] == $idusu)
                    $postulanteActivo = true;
                

                $isInactive = $post['Estado'] == "Inactiva";

            ?>

            <input type="hidden" id="idDeUser" value="<?php echo $idusu; ?>">
            <input type="hidden" id="idUserPost" value="<?php echo $idUserPost; ?>">

            <div class="card card-border post <?php echo $isInactive ? 'inactive-style' : ''; ?>">
                <div class="card-header card-border bg-transparent" style="padding: 3px; background-color: white !important">
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

                <?php if($postulanteActivo && $post['Estado'] == "Activa"){ ?>
                <div class="alert alert-dismissible fade show m-0" role="alert" style="background-color: rgba(18, 145, 154, 0.502);">
                    <i class="bi bi-info-circle"></i> Ahora puedes ver información adicional para completar este envio.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

                <div class="card-content <?php echo $isInactive ? 'inactive' : ''; ?>">
                    <div class="row m-auto">
                        <!-- USER INFO -->
                        <div class="col-10 p-0 d-flex flex-row align-items-center" id="infoUserPost">
                            <img class="postUserImg rounded-circle me-2" src="<?php echo $post['ImagenUsuario']; ?> ">
                            <div id="nombreUserPost">
                                <span class="txt"><?php echo $post['NombreUsuario']. " " . $post['ApellidoUsuario']. " "?></span>
                                <?php
                                    if ($post['Validado'] == 1) {
                                        echo ' <i class="bi bi-patch-check-fill align-self-center user-check"></i>';      
                                    } 
                                ?>

                                    <span class="badge text-bg-secondary" ><?php echo ($promedio != '-') ? $promedio. ' ★' : $promedio ?></span>

                                <?php
                                    if ($postulanteElegido && $post['Estado'] == "Activa" && !$postulanteActivo) {
                                ?>
                                    <span class="badge text-bg-secondary">Publicación pausada</span>
                                <?php
                                    } else if($post['Estado'] == "Inactiva"){
                                ?>
                                    <span class="badge" style="background-color: rgb(18, 146, 154);">Publicación finalizada</span>
                                <?php
                                    }
                                ?>

                            </div>
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

                    <!-- Contenido del post -->
                    <div class="row">
                        <div class="postDetailsPost col">
                            <h6 class="card-title"><?php echo $post['Titulo']; ?></h6>
                                <i class="fa-solid fa-location-dot"></i> 
                                Origen: <?php
                                        echo $post['ProvinciaOrigen'].", ".$post['LocalidadOrigen'].", ".$post['BarrioOrigen'];
                                        
                                            if($dueñoPost || $postulanteActivo){
                                            ?>
                                            <span class="postExtraInfo" id="buoy" data-value="<?php echo $postulanteActivo ?>">, 
                                                <span class="sel-txtExtra"><?php echo $post['DireccionOrigen']; ?></span>
                                            </span>
                                            <?php } 
                                        ?>
                                <br>
                                <i class="fa-solid fa-route"></i> 
                                Destino: <?php
                                        echo $post['ProvinciaDestino'].", ".$post['LocalidadDestino'].", ".$post['BarrioDestino'];
                                        
                                            if($dueñoPost || $postulanteActivo){
                                            ?>
                                            <span class="postExtraInfo">, 
                                                <span class="sel-txtExtra"><?php echo $post['DireccionDestino']; ?></span>
                                            </span>
                                            <?php } 
                                        ?>
                                <br>
                                <i class="fa-solid fa-calendar-days"></i>
                                Fecha límite para completar la entrega: <?php echo $post['FechaLimite'];?> <br>
                                <i class="fa-solid fa-ruler"></i> Volumen <br>
                                    Longitud: <?php echo $post['Largo']. ' cm'?> <br>
                                    Ancho: <?php echo $post['Ancho']. ' cm'?> <br>
                                    Alto: <?php echo $post['Alto']. ' cm'?> <br>
                                <i class="fa-solid fa-weight-scale"></i> Peso: <?php echo $post['Peso']. ' g <br>';
                                if ($post['Fragil'] == 'si') { ?>
                                    <span class="txt redLink">FRAGIL</span><br>
                                <?php
                                }
                                echo $post['Descripcion'];

                                if($dueñoPost || $postulanteActivo){
                                ?>
                                <div class="postExtraInfo">
                                    <h6 class="card-subtitle mb-1 mt-2 text-body-secondary">Información del remitente</h6>
                                    <span class="sel-txtExtra"><i class="fa-solid fa-user"></i> Nombre: <?php echo $post['NombreRemitente']; ?></span> <br>
                                    <span class="sel-txtExtra"><i class="fa-solid fa-phone"></i> Teléfono: <?php echo $post['TelefonoRemitente']; ?></span> <br>
                                </div>
                                <?php } 
                                ?>
                        </div>
                    </div>
                    
                    <!-- BOTON POSTULACION -->
                    <?php
                        if(!$dueñoPost && !$postulanteElegido && !$isPostulado){
                    ?>
                    <div class="d-flex justify-content-end align-items-center me-3">
                    <button class="btn btn-deli link" onclick="validarPostulacion()"> 
                        <span class="txt">Postularme</span> 
                    </button>

                    </div>
                    <div id="vehiculoAlerta" class="alert alert-warning alert-dismissible fade show mt-2" role="alert" style="display:none;">
                        Para poder postularse necesita cargar al menos un vehículo, podrá cargarlos <a href="perfildeusuario.php#vehiculos" class="alert-link">aquí</a>.
                    </div>

                    <?php
                        }
                    ?>

                    <!-- Botón de "Finalizar envío" solo para el postulante -->
                    <?php if ($postulanteActivo && $post['Estado'] !== "Inactiva") { ?>
                        <div class="d-flex justify-content-end align-items-center me-3">
                            <form action="finalizar_envio.php" method="POST">
                                <input type="hidden" name="idPublicacion" value="<?php echo $idpost; ?>">
                                <input type="hidden" name="idPostulante" value="<?php echo $postulanteElegido; ?>">
                                <button type="submit" class="btn btn-deli">
                                    <span class="txt">Finalizar envío</span>
                                </button>
                            </form>
                        </div>
                    <?php } ?>
                </div>

                <div class="card-footer card-border d-flex <?php echo $isInactive ? 'inactive' : ''; ?>">
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
                                    <i class="fa-solid fa-address-card"></i> Ver postulante
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
            <?php
                if ($post['Estado'] != "Inactiva") {
            ?>
                <div id="postBottom mb-4">
                    <?php
                            include 'comentarios.php';
                    ?>
                    <?php
                            

                            include 'postulaciones.php';
                    ?>
                </div>
            <?php
                }
            ?>

            
        </div>

        <!-- columna: Notificaciones -->
            <?php
                // include 'sidebarright.php'
            ?>
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
<script>
    function validarPostulacion() {
        const formData = new FormData();
        formData.append('usuarioId', <?php echo $_SESSION['idUser']; ?>);
        
        fetch('verificar_vehiculos.php', {
            method: 'POST',
            body: formData 
        })
        .then(response => response.json())
        .then(data => {
            if (data.tieneVehiculos) {
                var modal = new bootstrap.Modal(document.getElementById('modalpostularse'));
                modal.show();
            } else {
                var alerta = document.getElementById('vehiculoAlerta');
                alerta.style.display = 'block';
            }
        })
        .catch(error => console.error('Error al verificar vehículos:', error));
    }
</script>

    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>   
   <?php
        unset($_SESSION['success']);
        unset($_SESSION['msg']);
        include "DesconexionBS.php";
    ?>
</body>

</html>