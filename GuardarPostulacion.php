<?php
include "ConexionBS.php";

session_start();
extract($_POST);
$nombreUser = $_SESSION['usuario'] ;
$idUser = $_SESSION['idUser'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('d/m/Y');

if(isset($monto) && isset($comentario)){

    $postulacion = "INSERT INTO postulaciones (IdPublicacionPostulacion, IdUsuarioPostulacion, FechaPostulacion, Monto, ComentarioPostulacion)
    VALUES ('".$idPubli."', '".$idUser."', '".$fecha."', '".$monto."', '".$comentario."') ";
    mysqli_query($conexion, $postulacion);
    header("Location: PaginaPrincipal.php?". session_id());
}

include "DesconexionBS.php"

?>