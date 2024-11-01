<?php
session_start();
include "ConexionBS.php";

header('Content-Type: application/json');
header('Cache-Control: no-cache');

// Verificamos si hay un usuario logueado
$idusu = $_SESSION['idUser'];

// Obtener las notificaciones más recientes del usuario logueado
$query = "SELECT * FROM notificaciones 
          WHERE IdUsuario = '$idusu' AND Estado = 0 
          ORDER BY STR_TO_DATE(FechaDeNotificacion, '%d/%m/%Y %H:%i') DESC";

$resultado = mysqli_query($conexion, $query);

$notificaciones = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $notificaciones[] = $fila;
}

// Devolver notificaciones como JSON
echo json_encode($notificaciones);
?>
