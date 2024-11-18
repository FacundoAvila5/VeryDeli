<?php
// Conexión a la base de datos
include 'ConexionBS.php';

$usuario = $_SESSION['idUser'];

// Obtener la fechas de las notif de calificaciónes
$sql = "SELECT IdPublicacion, IdNotificacion, FechaDeNotificacion FROM notificaciones 
        WHERE IdUsuario = '$usuario' AND TipoNotificacion = 'Envio' AND Estado = '0'
        ORDER BY FechaDeNotificacion DESC";
$resultado = mysqli_query($conexion, $sql);

// Verificar el estado de tiempo de las notificaciones para saber si paso el tiempo o no
while ($row = mysqli_fetch_assoc($resultado)) {
    $fecha = DateTime::createFromFormat('d/m/Y H:i', $row['FechaDeNotificacion']); 
    $fechaActual = new DateTime(); 
    // Calcular la diferencia en días 
    $interval = $fecha->diff($fechaActual); 
    $diasPasados = $interval->days; 
    if ($diasPasados >= 7) { 
        
        //Poner en estado vista (1) la notificacion ...
        $sql= "UPDATE notificaciones SET Estado='1' 
            WHERE IdNotificacion='".$row['IdNotificacion']."' ";
        $resultado2 = mysqli_query($conexion, $sql);
        //... dar calificacion negativa al usuarion ...
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaCal = date('d/m/Y');
        $sql="INSERT INTO calificaciones (IdPublicacion, IdCalificador, IdCalificado, FechaCalificacion, Puntaje) 
            VALUES ('".$row['IdPublicacion']."','1','".$_SESSION['idUser']."','".$fechaCal."',-1)"; 
        $insert_cal_negativa= mysqli_query ($conexion,$sql);
        //... y notificar al usuario de la penalizacion
        if ($resultado2) {
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaHora = date('d/m/Y H:i');

            $crearNoti = "INSERT INTO notificaciones (IdUsuario, TipoNotificacion, FechaDeNotificacion, Mensaje, IdPublicacion, Estado, IdUsuarioCalificar) 
                        VALUES ( '".$_SESSION['idUser']."' , 'Penalizacion', '$fechaHora', 'Lo sentimos, fuiste penalizado con calificación negativa.', 0 , 0 , 0)";
            mysqli_query($conexion, $crearNoti);
        }
    }
}