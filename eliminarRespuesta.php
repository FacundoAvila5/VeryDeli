<?php
include "ConexionBS.php";
extract($_POST);

$delete = "DELETE FROM respuestas WHERE IdRespuesta = $idRta";
$deleteRes = mysqli_query($conexion, $delete);

include "DesconexionBS.php";

if($deleteRes){
    header("Location: post.php?id=" .$idPost );
    exit();
}else{
    echo '<script> alert("Ha ocurrido un error al eliminar la respuesta. Por favor vuelve a intentarlo.")</script>';
}
