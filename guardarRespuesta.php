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

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaHora = date('d/m/Y H:i');

    $queryIdPublicacion = "SELECT IdPublicacionMensaje FROM mensajes WHERE IdMensaje = '$idMje'";
    $resultado = mysqli_query($conexion, $queryIdPublicacion);
    $fila = mysqli_fetch_assoc($resultado);
    $idPublicacionMensaje = $fila['IdPublicacionMensaje'];

    $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                  VALUES ('$idPublicacionMensaje', 'Normal', '$fechaHora', 'Han respondido a tu consulta', '$idpost', 0 , 0)";
    mysqli_query($conexion, $crearNoti);

    include "DesconexionBS.php";

    header("Location: post.php?id=" .$idpost );
    exit();
}