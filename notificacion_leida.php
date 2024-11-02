<?php
include "ConexionBS.php";
session_start();

$idNotificacion = $_POST['IdNotificacion'] ?? null;

if ($idNotificacion) {
    $actualizacion = "UPDATE notificaciones SET Estado = 1 WHERE IdNotificacion = '$idNotificacion'";
    $resultado = mysqli_query($conexion, $actualizacion);

    if (mysqli_affected_rows($conexion) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar la notificación.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de notificación no válido.']);
}

include "DesconexionBS.php";
?>
