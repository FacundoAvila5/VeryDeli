<?php 
    $foto = $_SESSION['fotoPerfil'];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date('d/m/Y');
?>

<div id="comentarios">
    <!-- *** PREGUNTAR = no es dueño de la publi = usuario en sesion -->
     <?php if(($post['IdUsuario'] != $idusu)){ ?>
    <div class="comment bg-white">
        <div class="row p-2 mb-3">
            <div class="col-1 d-flex justify-content-start">
                <img class="postUserImg rounded-circle" src="<?php echo $foto; ?>">
            </div>
            <div class="col-11">
                <form method="post" class="cForm">
                    <input type="text" class="cInput form-control" name="mInput" placeholder="Escribe aquí tu mensaje"></input>
                    <button class="btn" name="btn-mje" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- guardar comentario -->
    <?php

        if(isset($_POST['btn-mje'])){ //ARREGLAR
            $guardar = "INSERT INTO mensajes (IdPublicacionMensaje, IdUsuarioMensaje, ContenidoMensaje, FechaMensaje) 
                        VALUES ('".$idpost."','".$idusu."','".$_POST['mInput']."','".$fecha."')";
            mysqli_query($conexion, $guardar);
        }
    ?>

    <!-- mostrar comentarios -->
    <?php
        $sql = "SELECT m.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
        FROM mensajes m
        INNER JOIN usuarios u ON m.IdUsuarioMensaje = u.IdUsuario";
        $mensajes = mysqli_query($conexion, $sql);

        while ($mje = mysqli_fetch_assoc($mensajes)) {
            if($mje['IdPublicacionMensaje'] == $idpost){
    ?>

    <!-- comentario -->
    <div class="comment bg-white">
        <div class="row p-2 mb-3">
            <div class="col-1 d-flex justify-content-start">
                <img class="postUserImg rounded-circle" src="<?php echo $mje['ImagenUsuario']; ?>">
            </div>
            <div class="col-11 d-flex align-items-center">
                <div class="row">
                    <div class="col-12">
                        <span class="txt"><?php echo $mje['NombreUsuario'] ." ". $mje['ApellidoUsuario']; ?></span> 
                        <span class="fecha"> <?php echo $mje['FechaMensaje']; ?></span>
                    </div>
                    <div class="col-12">
                        <?php echo $mje['ContenidoMensaje']; ?>
                    </div>
                    <div class="col-12">
                        <?php
                        // *** RESPONDER = usuario activo = sí es dueño de la publi = no es el autor del mensaje
                            if(($post['IdUsuario'] == $idusu) && ($mje['IdUsuarioMensaje'] != $idusu)){
                        ?>
                            <button class="btn bt-sm boton" value="<?php echo $mje['IdMensaje']; ?>" onclick="Responder(this)">Responder</button>  
                        <?php 
                            } 
                            if($mje['IdUsuarioMensaje'] == $idusu){
                        ?>
                            <button class="btn bt-sm boton redLink">Eliminar</button>
                        <?php } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mostrar respuesta -->

    <!-- respuesta -->

    <!-- RESPONDER -->
    <div class="respuesta row mb-3 d-none" id="<?php echo $mje['IdMensaje']; ?>">
        <div class="col-1"></div>
        <div class="col">
            <div class="comment bg-white">
                <div class="row p-2">
                    <div class="col-1 d-flex justify-content-start">
                        <img class="postUserImg rounded-circle" src="<?php echo $foto; ?>">
                    </div>
                    <div class="col-11">
                        <form method="post" class="cForm">
                            <input type="text" class="cInput form-control" name="rInput" placeholder="Escribe aquí tu respuesta"></input>
                            <button class="btn" name="btn-rta" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        } //if mostrar comentarios
        
        // GUARDAR respuesta
        if(isset($_POST['btn-rta'])){ //ARREGLAR
            $guardar = "INSERT INTO respuestas (IdMensaje, IdUsuarioRespuesta, ContenidoRespuesta, FechaRespuesta) 
                        VALUES ('".$faltaidmensaje."','".$idusu."','".$_POST['rInput']."','".$fecha."')";
            mysqli_query($conexion, $guardar);
        }
    ?>

    <?php
    } //while
    ?>
    
</div>