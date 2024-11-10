<?php
session_start();
include "ConexionBS.php";
extract($_POST);

$delete = "DELETE FROM mensajes WHERE IdMensaje = $idMje";
$deleteRes = mysqli_query($conexion, $delete);

include "DesconexionBS.php";

if($deleteRes){
    $_SESSION['success'] = true;
    $_SESSION['msg'] = "Se ha eliminado su mensaje.";
    header("Location: post.php?id=" .$idPost );
    exit();
}else{
    echo '<script> alert("Ha ocurrido un error al eliminar el comentario. Por favor vuelve a intentarlo.")</script>';
}
