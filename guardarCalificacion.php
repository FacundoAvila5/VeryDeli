<?php

    extract($_POST);
    $calificacion_final= 0; //Valor por defecto: calificacion negativa
    switch ($calificacion) {
        case 'enojado':
            $calificacion_final= 0;
            break;
        case 'triste':
            $calificacion_final= 25;
            break;
        case 'normal':
            $calificacion_final= 50;
            break;
        case 'feliz':
            $calificacion_final= 75;
            break;
        case 'muyfeliz':
            $calificacion_final= 100;
            break;
    }
    
    include 'ConexionBS.php';

    $sql= "INSERT INTO calificaciones (IdPublicacion, IdCalificador, IdCalificado, FechaCalificacion, Puntaje, Comentario)
            VALUES ()";
    $consulta= mysqli_query($conexion, $sql);

    include 'DesconexionBS.php';

?>