<?php
include "ConexionBS.php";

session_start();
extract($_POST);
$nombreUser = $_SESSION['usuario'] ;
$idUser = $_SESSION['idUser'];
$idPublicacion = '';

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('d/m/Y');

if(isset($monto) &&isset($comentario)){

    $postulacion = "INSERT INTO postulaciones (IdPublicacion, IdUsuarioPostulacion, FechaPostulacion, Monto, ComentarioPostulacion)
    VALUES ('".$idPublicacion."', '".$idUser."', '".$fecha."', '".$monto."', '".$comentario."',) ";
    mysqli_query($conexion, $postulacion);
    header("Location: PaginaPrincipal.php?". session_id());
}

include "DesconexionBS.php"

?>