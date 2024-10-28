<?php
include('ConexionBS.php'); 

if (isset($_GET['id'])) {
    $idVehiculo = $_GET['id'];

    $sql = "DELETE FROM vehiculos WHERE IdVehiculo = $idVehiculo";

    if (mysqli_query($conexion, $sql)) {
        // Redirigir a la página anterior con un mensaje de éxito
        header("Location: perfildeusuario.php?mensaje=Vehículo eliminado con éxito.");
        exit();
    } else {
        // Redirigir con un mensaje de error
        header("Location: perfildeusuario.php?error=Error al eliminar el vehículo.");
        exit();
    }
}

include "DesconexionBS.php";
?>
