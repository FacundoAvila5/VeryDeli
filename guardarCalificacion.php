<?php
session_start();
include "ConexionBS.php";
$idusu = $_SESSION['idUser'];

if (isset($_POST['calificacion']) && isset($_POST['idNotificacion'])) {
    $calificacion = $_POST['calificacion'];
    $calificacion_final = 0; 
    
    switch ($calificacion) {
        case 'enojado':
            $calificacion_final = 0;
            break;
        case 'triste':
            $calificacion_final = 25;
            break;
        case 'normal':
            $calificacion_final = 50;
            break;
        case 'feliz':
            $calificacion_final = 75;
            break;
        case 'muyfeliz':
            $calificacion_final = 100;
            break;
    }

    $comentario = $_POST['comentario'] ?? ''; 
    $idNotificacion = $_POST['idNotificacion'];

    $sql = "SELECT * FROM notificaciones WHERE IdNotificacion = '$idNotificacion'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $notificacion = mysqli_fetch_assoc($resultado);
        
        $idPublicacion = $notificacion['IdPublicacion'];
        $idUsuario = $notificacion['IdUsuario'];  
        $idUsuarioCalificar = $notificacion['IdUsuarioCalificar']; 

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaHora = date('d/m/Y H:i');

        $sql_insert = "INSERT INTO calificaciones (IdPublicacion, IdCalificador, IdCalificado, FechaCalificacion, Puntaje, Comentario)
                       VALUES ('$idPublicacion', '$idusu', '$idUsuarioCalificar', '$fechaHora', '$calificacion_final', '$comentario')";

        if (mysqli_query($conexion, $sql_insert)) {
            $actualizacion = "UPDATE notificaciones SET Estado = 1 WHERE IdNotificacion = '$idNotificacion'";
            $resultado = mysqli_query($conexion, $actualizacion);

            $sql_check = "SELECT * FROM calificaciones WHERE IdPublicacion = '$idPublicacion' AND IdCalificador = '$idUsuarioCalificar'";
            $check_result = mysqli_query($conexion, $sql_check);

            if (mysqli_num_rows($check_result) > 0) {
                $calificacionResult = mysqli_fetch_assoc($check_result);
                $puntaje = $calificacionResult['Puntaje'];
                $comentarioResult = $calificacionResult['Comentario'];
            
                $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                                VALUES ('$idusu', 'Normal', '$fechaHora', 'Fuiste calificado con un puntaje de: $puntaje% $comentarioResult. En una publicación.' , '$idPublicacion', 0, 0)";
                mysqli_query($conexion, $crearNoti);

                $crearNoti2 = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                                VALUES ('$idUsuarioCalificar', 'Normal', '$fechaHora', 'Fuiste calificado con un puntaje de: $calificacion_final% $comentario. En una publicación', '$idPublicacion', 0, 0)";
                mysqli_query($conexion, $crearNoti2);
            }
            
            $_SESSION['alert_message'] = "¡Gracias por calificar a tu socio!";
            header("Location: PaginaPrincipal.php");
            exit();
        } else {
            echo "<p class='text-danger'>Hubo un error al guardar la calificación.</p>";
        }
    } else {
        echo "<p class='text-danger'>No se encontró la notificación con ese ID.</p>";
    }
} else {
    echo "<p class='text-danger'>Faltan datos para procesar la calificación.</p>";
}

include "DesconexionBS.php";
?>
