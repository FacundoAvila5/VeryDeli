<?php 
    $foto = $_SESSION['fotoPerfil'];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date('d/m/Y');
?>

<div id="comentarios">
    <!-- *** PREGUNTAR = no es dueño de la publi = usuario en sesion -->
     <?php if($post['IdUsuario'] != $idusu){ ?>
    <div class="comment bg-white">
        <div class="row p-2 mb-3">
            <div class="col-1 d-flex justify-content-start">
                <img class="postUserImg rounded-circle" src="<?php echo $foto; ?>">
            </div>
            <div class="col-11">
                <form method="post" class="cForm">
                    <input type="text" class="cInput form-control" name="mInput" placeholder="Escribe aquí tu mensaje" required></input>
                    <button class="btn" name="btn-mje" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- guardar comentario -->
    <?php

        if(isset($_POST['btn-mje'])){
            $guardar = "INSERT INTO mensajes (IdPublicacionMensaje, IdUsuarioMensaje, ContenidoMensaje, FechaMensaje) 
                        VALUES ('".$idpost."','".$idusu."','".$_POST['mInput']."','".$fecha."')";
            mysqli_query($conexion, $guardar);
            
            // $contadorC++;
            // echo '<script> updateContC() </script>';
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
                $idMje = $mje['IdMensaje'];
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
                            <button class="btn bt-sm boton" value="<?php echo $idMje; ?>" onclick="Responder(this)">Responder</button>  
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

    <!-- mostrar respuestas en BDD -->
    <?php
        $consulta = "SELECT r.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
        FROM respuestas r
        INNER JOIN usuarios u ON r.IdUsuarioRespuesta = u.IdUsuario";
        $respuesta = mysqli_query($conexion, $consulta);

        while($rta = mysqli_fetch_assoc($respuesta)){

            $idm = $rta['IdMensaje'];
            $sql = "SELECT m.IdPublicacionMensaje
            FROM mensajes m
            INNER JOIN respuestas r ON m.IdMensaje = $idm";

            $consulta = mysqli_query($conexion, $sql);
            $idp = mysqli_fetch_assoc($consulta);

            if(($idp['IdPublicacionMensaje'] == $idpost) && ($idMje == $idm)){
     ?>

            <!-- respuesta -->
            <div class="respuesta row mb-3">
                <div class="col-1"></div>
                <div class="col">
                    <div class="comment bg-white">
                        <div class="row p-2">
                            <div class="col-1 d-flex justify-content-start">
                                <img class="postUserImg rounded-circle" src="<?php echo $rta['ImagenUsuario']; ?>">
                            </div>
                            <div class="col-11 d-flex align-items-center">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="txt"><?php echo $rta['NombreUsuario'] ." ". $rta['ApellidoUsuario']; ?></span> 
                                        <span class="fecha"> <?php echo $rta['FechaRespuesta']; ?></span>
                                    </div>
                                    <div class="col-12">
                                        <?php echo $rta['ContenidoRespuesta']; ?>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn bt-sm boton redLink">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     <?php
            } //if
        } //while
    ?>

    <!-- RESPONDER -->
    <div class="respuesta row mb-3 d-none" id="<?php echo $idMje; ?>">
        <div class="col-1"></div>
        <div class="col">
            <div class="comment bg-white">
                <div class="row p-2">
                    <div class="col-1 d-flex justify-content-start">
                        <img class="postUserImg rounded-circle" src="<?php echo $foto; ?>">
                    </div>
                    <div class="col-11">
                        <form method="post" class="cForm">
                            <input type="hidden" name="idMje" value="<?php echo $idMje; ?>">
                            <input type="text" class="cInput form-control" name="rInput" placeholder="Escribe aquí tu respuesta" required></input>
                            <button class="btn" name="btn-rta" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
            } //if mostrar comentarios
        } //while
        
        // GUARDAR respuesta
        if(isset($_POST['btn-rta'])){ 
            $respuesta = htmlspecialchars($_POST['rInput']);
            $guardar = "INSERT INTO respuestas (IdMensaje, IdUsuarioRespuesta, ContenidoRespuesta, FechaRespuesta) 
                        VALUES ('".$_POST['idMje']."','".$idusu."','".$respuesta."','".$fecha."')";
            mysqli_query($conexion, $guardar);

            // header("Location: " . $_SERVER['PHP_SELF']);
            // exit();

            // $consulta = "SELECT r.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
            // FROM respuestas r
            // INNER JOIN usuarios u ON r.IdUsuarioRespuesta = u.IdUsuario";
            // $respuesta = mysqli_query($conexion, $consulta);
        }
    ?>

</div>