<?php

include "ConexionBS.php";
session_start();
extract($_POST);
$flag = false;
if(isset($busqueda) && !empty($busqueda)){

    $consultaBusqueda = " SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario
    FROM publicaciones p
    INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
    where p.ProvinciaOrigen = '$busqueda' 
    OR p.LocalidadOrigen = '$busqueda' 
    OR p.BarrioOrigen = '$busqueda' 
    OR p.LocalidadDestino = '$busqueda' 
    OR p.BarrioDestino = '$busqueda' 
    OR p.DireccionDestino = '$busqueda'  
    ORDER BY p.IdPublicacion DESC";
    $resultado = mysqli_query($conexion, $consultaBusqueda);

    if(mysqli_num_rows($resultado) > 0){
        $flag = true;
    }
    $_SESSION['resultadoBusqueda'] = $resultado;
    $_SESSION['flagBusqueda'] = $flag;
    header("Location: PaginaPrincipal.php?" . session_id());
    exit();
}
?>

