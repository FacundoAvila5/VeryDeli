<?php
    include 'ConexionBS.php';
    extract($_POST);
    if (isset($btn_ignorar)) {

        $sqli= "DELETE FROM denuncias WHERE idPublicacion = '".$idpost."' ";
        $con= mysqli_query($conexion,$sqli);
        include 'DesconexionBS.php';
        header("Location: post.php?id=" .$idpost );

    }
    if (isset($btn_eliminar)) {

        $sqli= "DELETE FROM publicaciones WHERE idPublicacion = '".$idpost."' ";
        $con= mysqli_query($conexion,$sqli);
        include 'DesconexionBS.php';
        header("Location: PaginaPrincipal.php" );

    }

?>