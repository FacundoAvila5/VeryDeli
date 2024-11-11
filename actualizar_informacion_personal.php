<?php
include "ConexionBS.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUser = $_SESSION['idUser'];

    $nombreUsuario = $_POST['nombreUsuario'];
    $apellidoUsuario = $_POST['apellidoUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $telefonoUsuario = $_POST['telefonoUsuario'];

    $targetFile = null;

    // Validación de imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "img/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $validImageTypes)) {
            $imageError = "Solo se permiten imágenes en formato JPG, JPEG, PNG y GIF.";
        }

        if (file_exists($targetFile)) {
            $imageError = "El archivo ya existe.";
        }

        if (empty($imageError) && !move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imageError = "Hubo un error al subir la imagen.";
        }

        if (empty($imageError)) {
            $_SESSION["fotoPerfil"] = $targetFile;
        }
    }

    if (empty($imageError)) {
        $query = "SELECT ImagenUsuario FROM usuarios WHERE IdUsuario = '$idUser'";
        $result = mysqli_query($conexion, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $currentImage = $row['ImagenUsuario'];
        } else {
            echo "Error al obtener la imagen actual: " . mysqli_error($conexion);
            exit();
        }

        if ($targetFile === null) {
            $targetFile = $currentImage;
        }

        $queryNombre = "SELECT NombreUsuario, TipoUsuario, ImagenUsuario FROM usuarios WHERE IdUsuario = '$idUser'";
        $resultNombre = mysqli_query($conexion, $queryNombre);
        if ($resultNombre) {
            $row = mysqli_fetch_assoc($resultNombre);
            $currentNombreUsuario = $row['NombreUsuario'];
            $currentTipoUsuario = $row['TipoUsuario'];
            $currentImage = $row['ImagenUsuario'];
        }

        $tipoUsuarioNuevo = $currentTipoUsuario;
        if ($nombreUsuario != $currentNombreUsuario) {
            $tipoUsuarioNuevo = "Normal";
        }

        $actualizacion = "UPDATE usuarios SET 
            NombreUsuario = '$nombreUsuario', 
            ApellidoUsuario = '$apellidoUsuario', 
            EmailUsuario = '$emailUsuario', 
            TelefonoUsuario = '$telefonoUsuario',
            ImagenUsuario = '$targetFile',
            TipoUsuario = '$tipoUsuarioNuevo'
            WHERE IdUsuario = '$idUser'";

        if (mysqli_query($conexion, $actualizacion)) {

            $_SESSION["usuario"] = $nombreUsuario." ".$apellidoUsuario;

            header("Location: perfildeusuario.php");
            exit();
        } else {
            echo "Error actualizando los datos: " . mysqli_error($conexion);
        }
    } else {
        echo $imageError; 
    }
}

include "DesconexionBS.php";
?>
