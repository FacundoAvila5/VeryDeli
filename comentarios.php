<div class="comentarios">
    <!-- *** PREGUNTAR = no es dueño de la publi = usuario en sesion -->
    <div class="comment bg-white">
        <div class="row p-2 mb-3">
            <div class="col-1 d-flex justify-content-start">
                <img class="postUserImg rounded-circle" src="<?php $foto = $_SESSION['fotoPerfil']; echo $foto; ?>">
            </div>
            <div class="col-11">
                <form method="post" class="cForm">
                    <input type="text" class="cInput form-control" name="cInput" placeholder="Escribe aquí tu mensaje"></input>
                    <button class="btn" name="btn-mje" type="submit"><i class="fa-regular fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- guardar comentario -->
    <?php
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date('d/m/Y');

        if(isset($_POST['btn-mje'])){ //ARREGLAR
            $guardar = "INSERT INTO mensajes (IdPublicacionMensaje, IdUsuarioMensaje, ContenidoMensaje, FechaMensaje) 
                        VALUES ('".$idpost."','".$idusu."','".$_POST['cInput']."','".$fecha."')";
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
                </div>
            </div>
        </div>
    </div>
    <?php
        } //if

        if(($post['IdUsuario'] == $idusu) && ($mje['IdUsuarioMensaje']!=$idusu)){
    ?>

    <!-- *** RESPUESTA = si es dueño de la publi -->
    <div class="respuesta row mb-3">
        <div class="col-1"></div>
        <div class="col">
            <div class="comment bg-white">
                <div class="row p-2">
                    <div class="col-1 d-flex justify-content-start">
                        <img class="postUserImg rounded-circle" src="img/1.jpg">
                    </div>
                    <div class="col-11 d-flex align-items-center">
                        <input type="text" class="cInput form-control" placeholder="Escribe aquí tu respuesta"></input>
                        <button class="btn"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        } //if
    } //while
    ?>
    
</div>