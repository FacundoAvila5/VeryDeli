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
        echo "Usuario rechazado correctamente.";
    }


include "DesconexionBS.php";


header("Location: VerificarUsuario.php?". session_id()); 
exit;
?>
