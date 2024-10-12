<?php


include "ConexionBS.php";
session_start();
extract($_POST);
$nombreusu = $_SESSION['usuario'];
$id = $_SESSION['idUser'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('d/m/Y');

if(isset($tituloPubli) && isset($provinciaorigen) && isset($Localidadorigen) && isset($barrioorigen) && isset($direccionorigen) 
&& isset($provinciadestino) && isset($Localidaddestino) && isset($barriodestino) && isset($direcciondestino) && isset($fechaLimite) 
&& isset($alto) && isset($ancho) && isset($largo) && isset($peso) && isset($fragil) && isset($descripcion) ){

$fech = DateTime::createFromFormat("Y-m-d", $fechaLimite);
$fechaFormateada = $fech ? $fech-> format('d/m/Y'): '';

    $guardaPubli = "INSERT INTO publicaciones (IdUsuario, NombreUsuario, Titulo, Descripcion, FechaPublicacion, FechaLimite, ProvinciaOrigen, 
    LocalidadOrigen, BarrioOrigen, DireccionOrigen, ProvinciaDestino, LocalidadDestino, BarrioDestino, DireccionDestino, Fragil, 
    Peso, Alto, Ancho, Largo ) VALUES ('".$id."', '".$nombreusu."', '".$tituloPubli."', '".$descripcion."', '".$fecha."', '".$fechaFormateada."',
     '".$provinciaorigen."', '".$Localidadorigen."', '".$barrioorigen."', '".$direccionorigen."', '".$provinciadestino."',
     '".$Localidaddestino."', '".$barriodestino."', '".$direcciondestino."', '".$fragil."', '".$peso."', '".$alto."', '".$ancho."',
     '".$largo."' )";
     mysqli_query($conexion, $guardaPubli);
     header("location: Principal.php?".session_id());
                                                              
}
include "DesconexionBS.php";
?>