<?php 

include "ConexionBS.php";

session_start();
extract($_POST);
$iduser = $_SESSION['idUser'];

if(isset($dni) && isset($cuil) && isset($_FILES['boleta'])){

    $target_dir = "validar/";
    $target_file = $target_dir.basename(($_FILES["boleta"]["name"]));

    if (move_uploaded_file($_FILES["boleta"]["tmp_name"], $target_file)){
    $guardarValidacion = "INSERT INTO validaciones (IdUsuarioValidacion, DNIUsuarioValidacion, CUILUsuarioValidacion, ImagenValidacion)
    VALUES ('".$iduser."','".$dni."','".$cuil."','".$target_file."')";
    mysqli_query($conexion, $guardarValidacion);
    header("Location: perfildeusuario.php?" . session_id());
    exit();
    }else{
        echo "Error al subir el archivo.";
    }
}

include "DesconexionBS.php";

?>