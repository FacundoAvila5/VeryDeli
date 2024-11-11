<?php
include "ConexionBS.php";
extract($_POST);    

    if ($accion == 'validar') {
        $revision = "UPDATE validaciones 
                     SET Estado = 'Revisada' 
                     WHERE IdUsuarioValidacion = $idUsuario";
        $validacion = "UPDATE usuarios 
                       SET Validado = '1' 
                       WHERE IdUsuario = $idUsuario";
        mysqli_query($conexion, $revision);
        mysqli_query($conexion, $validacion);
        echo "Usuario validado correctamente.";
    } elseif ($accion == 'rechazar') {
        $revision = "UPDATE validaciones 
                     SET Estado = 'Revisada' 
                     WHERE IdUsuarioValidacion = $idUsuario";
        mysqli_query($conexion, $revision);

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaHora = date('d/m/Y H:i');

        $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                    VALUES ($idUsuario, 'verificado', '$fechaHora', 'Ya eres un usuario verificado', 0, 0 , 0)";
        mysqli_query($conexion, $crearNoti);


        echo "Usuario rechazado correctamente.";
    }


include "DesconexionBS.php";


header("Location: VerificarUsuario.php?". session_id()); 
exit;
?>
