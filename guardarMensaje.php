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

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaHora = date('d/m/Y H:i');

    $queryUsuarioPublicacion = "SELECT IdUsuario FROM publicaciones WHERE IdPublicacion = '$idpost'";
    $resultado = mysqli_query($conexion, $queryUsuarioPublicacion);
    $fila = mysqli_fetch_assoc($resultado);
    $idUsuarioPublicacion = $fila['IdUsuario'];

    $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                  VALUES ('$idUsuarioPublicacion', 'Normal', '$fechaHora', 'Tienes un nuevo mensaje en tu publicación', '$idpost', 0 , 0)";
    mysqli_query($conexion, $crearNoti);

    include "DesconexionBS.php";

    $_SESSION['success'] = true;
    $_SESSION['msg'] = "Su pregunta ha sido enviada con éxito.";
    header("Location: post.php?id=" .$idpost );
    exit();
}