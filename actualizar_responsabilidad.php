<!-- Cod calificacion negativa:
    $sql="INSERT INTO calificaciones (IdPublicacion, IdCalificador, IdCalificado, FechaCalificacion, Puntaje) VALUES (-,'1',".$_SESSION['idUser'].",-,-1)"; 
    $insert_cal_negativa= mysqli_query ($conexion,$sql);
-->
<?php
//Actualiza el estado de Usuario Responsable / Normal del dueño de la sesión

    include 'ConexionBS.php';
    $usuario= $_SESSION['idUser'];
    $tipo= $_SESSION['tipoUser'];
    
    switch ($tipo) {
        case 'Normal': //USUARIO NORMAL
            //Controla ultimas 5 calificaciones para asignar tipo responsable
            $sql= "SELECT Puntaje 
                FROM calificaciones 
                WHERE IdCalificado = ".$usuario." AND Puntaje <> -1
                ORDER BY IdCalificacion DESC
                LIMIT 5";
            $resultado= mysqli_query($conexion,$sql);
            if (mysqli_num_rows($resultado)==5) { 
                $suma=0;
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $suma += $row['Puntaje'];
                }
                $promedio= $suma / 5;

                if ($promedio > 80) {
                    $sql= "UPDATE usuarios SET TipoUsuario='Responsable'
                        WHERE IdUsuario=". $usuario;
                    $resultado= mysqli_query($conexion,$sql);
                    $_SESSION['tipoUser']='Responsable';
                    // ** CARTEL FELICIDADES ES USUARIO RESPONSABLE **
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "¡Felicidades, ahora es usuario responsable!";
                }
            }
            break;

        case 'Responsable': //USUARIO RESPONSABLE

            //Controla las ultimas 3 calificaciones para quitar Responsable
            $sql= "SELECT Puntaje 
                FROM calificaciones 
                WHERE IdCalificado = ".$usuario." AND Puntaje <> -1
                ORDER BY IdCalificacion DESC
                LIMIT 3";
            $resultado= mysqli_query($conexion,$sql);
            if (mysqli_num_rows($resultado)==3) {
                $suma=0;
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $suma += $row['Puntaje'];
                }
                $promedio= $suma / 3;

                if ($promedio < 40) {
                    $sql= "UPDATE usuarios SET TipoUsuario='Normal'
                        WHERE IdUsuario=". $usuario;
                    $resultado= mysqli_query($conexion,$sql);
                    $_SESSION['tipoUser']='Normal';
                    // ** CARTEL PERDIO LA CATEGORIA DE RESPONSABLE (POR BAJAS CALIFICACIONES) **
                    $_SESSION['success'] = false;
                    $_SESSION['msg'] = "¡Malas noticias! A perdido su categoría de responsable.";
                }
            }

            //Controla que las ultimas 2 calificaciones sean negativas para quitar Responsable
            $sql= "SELECT Puntaje 
                FROM calificaciones 
                WHERE IdCalificado = ".$usuario." 
                ORDER BY IdCalificacion DESC
                LIMIT 2";
            $resultado= mysqli_query($conexion,$sql);
            if (mysqli_num_rows($resultado)==2) {
                $cant_negativas=0;
                while ($row = mysqli_fetch_assoc($resultado)) {
                    if ($row['Puntaje']==-1) { $cant_negativas+=1; }
                }
                if ($cant_negativas==2) {
                    $sql= "UPDATE usuarios SET TipoUsuario='Normal'
                        WHERE IdUsuario=". $usuario;
                    $resultado= mysqli_query($conexion,$sql);
                    $_SESSION['tipoUser']='Normal';
                    // ** CARTEL PERDIO LA CATEGORIA DE RESPONSABLE (POR NO CALIFICAR) **
                    $_SESSION['success'] = false;
                    $_SESSION['msg'] = "¡Malas noticias! A perdido su categoría de responsable.";
                }
            }
            break;
    }

    // include 'DesconexionBS.php';
?>