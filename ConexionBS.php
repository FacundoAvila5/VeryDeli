<?php

$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$bd = "verydeli";

$conexion = new mysqli($servidor, $usuario, $contrasenia, $bd);


if($conexion->connect_error){
    die("conexion fallida: " . $conexion->connect_error);
}
?>