<?php
session_start();
include "ConexionBS.php";

$idUsuario = $_POST['usuarioId'];

$query = "SELECT COUNT(*) AS total FROM vehiculos WHERE Id_Usuario = '$idUsuario'";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    $tieneVehiculos = $row['total'] > 0;

    echo json_encode(['tieneVehiculos' => $tieneVehiculos]);
} else {
    echo json_encode(['error' => 'Error en la consulta.']);
}

include "DesconexionBS.php";
?>
