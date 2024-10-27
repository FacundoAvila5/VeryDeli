<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vehiculos = $_POST['vehiculos'];
    $contador = 0; 

    foreach ($vehiculos as $key => $vehiculo) {
        if (!empty($vehiculo['Marca']) && !empty($vehiculo['Modelo']) && $contador < 2) {
            $contador++;

            saveVehicleToDatabase($vehiculo); 
        }
    }

    header("Location: perfildeusuario.php");
    exit();
}

function saveVehicleToDatabase($vehiculo) {
    include 'ConexionBS.php';
    $idUser = $_SESSION['idUser'];
    $idVehiculo = $vehiculo['IdVehiculo'];
    $marca = $vehiculo['Marca'];
    $modelo = $vehiculo['Modelo'];
    $alto = $vehiculo['Alto'];
    $ancho = $vehiculo['Ancho'];
    $largo = $vehiculo['Largo'];
    $capacidadPeso = $vehiculo['Capacidad_Peso'];

    if (!empty($idVehiculo)) {
        // Actualizar vehículo existente
        $sql = "UPDATE vehiculos 
                SET Marca='$marca', Modelo='$modelo', Alto='$alto', Ancho='$ancho', Largo='$largo', Capacidad_Peso='$capacidadPeso'
                WHERE Id_Vehiculo='$idVehiculo' AND Id_Usuario='$idUser'";
    } else {
        // Insertar nuevo vehículo
        $sql = "INSERT INTO vehiculos (Id_Usuario, Marca, Modelo, Alto, Ancho, Largo, Capacidad_Peso)
                VALUES ('$idUser', '$marca', '$modelo', '$alto', '$ancho', '$largo', '$capacidadPeso')";
    }

    if (!mysqli_query($conexion, $sql)) {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}


?>
