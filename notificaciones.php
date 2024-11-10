<?php
session_start();
include "ConexionBS.php";

header('Content-Type: application/json');
header('Cache-Control: no-cache');

$idusu = $_SESSION['idUser'];

$query = "SELECT * FROM notificaciones 
          WHERE IdUsuario = '$idusu' AND Estado = 0";

$resultado = mysqli_query($conexion, $query);

$notificaciones = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $notificaciones[] = $fila;
}

usort($notificaciones, function($a, $b) {
    $dateA = DateTime::createFromFormat('d/m/Y H:i', $a['FechaDeNotificacion']);
    $dateB = DateTime::createFromFormat('d/m/Y H:i', $b['FechaDeNotificacion']);
    return $dateB <=> $dateA; 
});

echo json_encode($notificaciones);

include "DesconexionBS.php";
?>
