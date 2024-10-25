<?php
include "ConexionBS.php";

$idpost = $_GET['id'];

$delete = "DELETE FROM publicaciones WHERE IdPublicacion = $idpost";
$deleteRes = mysqli_query($conexion, $delete);

include "DesconexionBS.php";

if($deleteRes){
    header("Location: PaginaPrincipal.php");
    exit();
}else{
    echo '<script> alert("Ha ocurrido un error al eliminar la publicación. Por favor vuelve a intentarlo.")</script>';
}