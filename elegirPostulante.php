<?php
session_start();
include "ConexionBS.php";

$consulta = "UPDATE publicaciones SET IdPostulante = $idpostu WHERE IdPublicacion = $idpost";
mysqli_query($conexion, $consulta);

include "DesconexionBS.php";

header("Location: post.php?id=" .$idpost );
exit();