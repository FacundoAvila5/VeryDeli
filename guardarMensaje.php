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

    // Obtener el IdUsuario de la tabla publicacion usando idpost
    $queryUsuarioPublicacion = "SELECT IdUsuario FROM publicaciones WHERE IdPublicacion = '$idpost'";
    $resultado = mysqli_query($conexion, $queryUsuarioPublicacion);
    $fila = mysqli_fetch_assoc($resultado);
    $idUsuarioPublicacion = $fila['IdUsuario'];

    // Insertar notificación en la tabla de notificaciones, con valores `NULL` para los campos no deseados
    $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                  VALUES ('$idUsuarioPublicacion', 'Normal', '$fechaHora', 'Tienes un nuevo mensaje en tu publicacion', '$idpost', 0 , 0)";
    mysqli_query($conexion, $crearNoti);

    include "DesconexionBS.php";

    header("Location: post.php?id=" .$idpost );
    exit();
}