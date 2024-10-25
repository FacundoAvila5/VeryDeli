<?php
session_start();
include "ConexionBS.php";

$idusu = $_SESSION['idUser'];
extract($_POST);

if(isset($mInput)){
    $mensaje = htmlspecialchars($mInput);
    $guardar = "INSERT INTO mensajes (IdPublicacionMensaje, IdUsuarioMensaje, ContenidoMensaje, FechaMensaje) 
                VALUES ('".$idpost."','".$idusu."','".$mensaje."','".$fecha."')";
    mysqli_query($conexion, $guardar);

    include "DesconexionBS.php";

    header("Location: post.php?id=" .$idpost );
    exit();
}