<?php
function calcularPromedio($id){
    include 'ConexionBS.php';
    
    $sql_prom= "SELECT Puntaje 
                FROM calificaciones 
                WHERE IdCalificado = ".$id." AND Puntaje <> -1";
    $resultado = mysqli_query($conexion, $sql_prom);
    $num = mysqli_num_rows($resultado);

    if($num > 0) { 
        $suma=0;
        while ($row = mysqli_fetch_assoc($resultado)){
            $suma += $row['Puntaje'];
        }
        $pre_promedio= $suma / $num;
        $promedio = ($pre_promedio / 100) * 5;
        $promedio = round($promedio, 2);
    }else{
        $promedio = 'Sin calificaciones';
    }
    
    include "DesconexionBS.php";

    return $promedio;
}
