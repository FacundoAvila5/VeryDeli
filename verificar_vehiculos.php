<?php
session_start();
include "ConexionBS.php";

// ID del usuario que está intentando postularse
$idUsuario = $_POST['usuarioId'];

// Consulta para verificar si el usuario tiene vehículos
$query = "SELECT COUNT(*) AS total FROM vehiculos WHERE Id_Usuario = '$idUsuario'";
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    $tieneVehiculos = $row['total'] > 0;

    // Devolver respuesta en formato JSON
    echo json_encode(['tieneVehiculos' => $tieneVehiculos]);
} else {
    // En caso de error en la consulta
    echo json_encode(['error' => 'Error en la consulta.']);
}

include "DesconexionBS.php";
?>
