<?php

include "ConexionBS.php";
session_start();
extract($_POST);
$flag = false;

if (isset($mostrar_todo) && $mostrar_todo === 'true') {
    $consultaBusqueda = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
                         FROM publicaciones p
                         INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                         ORDER BY p.IdPublicacion DESC";
}else if(isset($busqueda) && !empty($busqueda)){

    $consultaBusqueda = " SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
                        FROM publicaciones p
                        INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                        where p.ProvinciaOrigen = '$busqueda' 
                        OR p.LocalidadOrigen = '$busqueda' 
                        OR p.BarrioOrigen = '$busqueda' 
                        OR p.LocalidadDestino = '$busqueda' 
                        OR p.BarrioDestino = '$busqueda' 
                        OR p.DireccionDestino = '$busqueda'  
                        ORDER BY p.IdPublicacion DESC";
}else{
    $consultaBusqueda = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
                        FROM publicaciones p
                        INNER JOIN usuarios u ON p.IdUsuario = u.IdUsuario
                        ORDER BY p.IdPublicacion DESC";
}
$resultado = mysqli_query($conexion, $consultaBusqueda);
$_SESSION['resultadoBusqueda'] = [];
if(mysqli_num_rows($resultado) > 0){
    $flag = true;

    while ($row = mysqli_fetch_assoc($resultado)) {
    $_SESSION['resultadoBusqueda'][] = $row;
}
}

$_SESSION['flagBusqueda'] = $flag;
header("Location: PaginaPrincipal.php?" . session_id());
exit();
?>

