<?php
    include "ConexionBS.php";
    extract($_POST);

    $consulta = "UPDATE publicaciones SET IdPostulante = $idpostu WHERE IdPublicacion = $idpost";
    mysqli_query($conexion, $consulta);

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaHora = date('d/m/Y H:i');

    $idUsuarioPostulacion = "SELECT IdUsuarioPostulacion FROM postulaciones WHERE IdPostulacion = '$idpostu'";
    $resultado = mysqli_query($conexion, $idUsuarioPostulacion);
    $fila = mysqli_fetch_assoc($resultado);
    $idUsuarioPostulacion = $fila['IdUsuarioPostulacion'];

    $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                  VALUES ('$idUsuarioPostulacion', 'Normal', '$fechaHora', 'Fuiste seleccionado para realizar un envio.', '$idpost', 0 , 0)";
    mysqli_query($conexion, $crearNoti);

    include "DesconexionBS.php";

    header("Location: post.php?id=" .$idpost );
exit();