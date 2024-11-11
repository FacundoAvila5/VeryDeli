<?php
session_start();
include 'ConexionBS.php'; 

if (isset($_POST['idPublicacion'])) {
    $idPublicacion = intval($_POST['idPublicacion']); 
    $idPostulante = intval($_POST['idPostulante']);

    $sql = "UPDATE publicaciones SET Estado = 'Inactiva' WHERE IdPublicacion = $idPublicacion";

    if (mysqli_query($conexion, $sql)) {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaHora = date('d/m/Y H:i');

        $queryUsuarioPublicacion = "SELECT IdUsuario FROM publicaciones WHERE IdPublicacion = '$idPublicacion'";
        $resultado = mysqli_query($conexion, $queryUsuarioPublicacion);
        $fila = mysqli_fetch_assoc($resultado);
        $idUsuarioPublicacion = $fila['IdUsuario'];

        $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                    VALUES ('$idUsuarioPublicacion', 'Envio', '$fechaHora', 'Se finalizo el envio de tu paquete, por favor califica al delivery.', '$idPublicacion', 0 , '$idPostulante')";
        mysqli_query($conexion, $crearNoti);

        $crearNotificacion = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                    VALUES ('$idPostulante', 'Envio', '$fechaHora', 'Has finalizado el envio, por favor califica al creador de la publicación.', '$idPublicacion', 0 , '$idUsuarioPublicacion')";
        mysqli_query($conexion, $crearNotificacion);
        $_SESSION['success'] = true;
        $_SESSION['msg'] = "¡Envío finalizado con éxito!";
        header("Location: PaginaPrincipal.php");
        exit(); 
    } else {
        echo "Error al actualizar el estado de la publicación: " . mysqli_error($conexion);
    }

} else {
    echo "ID de publicación no recibido.";
}

include 'DesconexionBS.php';
?>
