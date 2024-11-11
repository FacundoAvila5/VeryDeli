<?php
include "ConexionBS.php";

session_start();
$errores = [];
$idUser = $_SESSION['idUser'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevaContrasena = $_POST['nuevaContrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];

    if ($nuevaContrasena !== $confirmarContrasena) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    if (empty($errores)) {
        $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        
        $actualizacion = "UPDATE usuarios SET 
            Contrasenia = '$hashedPassword' 
            WHERE IdUsuario = '$idUser'";

        if (mysqli_query($conexion, $actualizacion)) {
            $_SESSION['mensaje'] = "Contraseña cambiada correctamente.";
            header("Location: perfildeusuario.php");
            exit();
        } else {
            echo "Error actualizando los datos: " . mysqli_error($conexion);
        }
    } else {
        foreach ($errores as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
include "DesconexionBS.php";
?>
