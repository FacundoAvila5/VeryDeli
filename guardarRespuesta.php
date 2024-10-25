<?php
session_start();
include "ConexionBS.php";

$idusu = $_SESSION['idUser'];
extract($_POST);

// agregar controles jfc

if(isset($rInput)){ 
    $respuesta = htmlspecialchars($rInput);
    $guardar = "INSERT INTO respuestas (IdMensaje, IdUsuarioRespuesta, ContenidoRespuesta, FechaRespuesta) 
                VALUES ('".$idMje."','".$idusu."','".$respuesta."','".$fecha."')";
    mysqli_query($conexion, $guardar);

    include "DesconexionBS.php";

    header("Location: post.php?id=" .$idpost );
    exit();
}