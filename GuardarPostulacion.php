<?php
include "ConexionBS.php";

session_start();
extract($_POST);
$nombreUser = $_SESSION['usuario'] ;
$idUser = $_SESSION['idUser'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('d/m/Y');

if(isset($monto) && isset($comentario)){

    $postulacion = "INSERT INTO postulaciones (IdPublicacion, IdUsuarioPostulacion, FechaPostulacion, Monto, ComentarioPostulacion)
    VALUES ('".$idPubli."', '".$idUser."', '".$fecha."', '".$monto."', '".$comentario."') ";
    mysqli_query($conexion, $postulacion);

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaHora = date('d/m/Y H:i');

    $queryUsuarioPublicacion = "SELECT IdUsuario FROM publicaciones WHERE IdPublicacion = '$idPubli'";
    $resultado = mysqli_query($conexion, $queryUsuarioPublicacion);
    $fila = mysqli_fetch_assoc($resultado);
    $idUsuarioPublicacion = $fila['IdUsuario'];

    $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                  VALUES ('$idUsuarioPublicacion', 'Normal', '$fechaHora', 'Tienes una nueva postulación en tu publicación', '$idPubli', 0 , 0)";
    mysqli_query($conexion, $crearNoti);

    header("Location: PaginaPrincipal.php?". session_id());
}

include "DesconexionBS.php"

?>