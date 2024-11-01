<?php
include "ConexionBS.php";
extract($_POST);

$consulta = "UPDATE publicaciones SET IdPostulante = $idpostu WHERE IdPublicacion = $idpost";
mysqli_query($conexion, $consulta);

include "DesconexionBS.php";

header("Location: post.php?id=" .$idpost );
exit();