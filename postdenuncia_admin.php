<?php
    include 'ConexionBS.php';

    if ($_SESSION["tipo"]=="Administrador") { //Si el usuario es admin !!! CORREGIR TIPO !!!

        $sql= "SELECT u.NombreUsuario, d.FechaDenuncia, d.Motivo, d.ComentarioDenuncia 
            FROM denuncias d 
            JOIN usuarios u ON d.IdUsuario=u.IdUsuario
            WHERE IdPublicacion = '".$idpost."' ";
        $result= mysqli_query($conexion,$sql);

        if (mysqli_num_rows($result) > 0) { //Si hay denuncias en el post
            echo "<div class='row visual-denuncia p-3 rounded' style='margin: auto; background-color: #ffbfaa;'>
                <div class='row'>
                    <h5> Denuncias </h5>
                </div>
                <hr>";

            //iteracion sobre la cantidad de denuncias
            while($row = $resultado->fetch_assoc()) {
                echo "<div class='row'>
                    <div class='col-6'>
                        <p class='mb-0'><strong>Usuario:</strong> ".$row['NombreUsuario']."</p>
                    </div>
                    <div class='col-6 text-end'>
                        <p class='mb-0 text-body-tertiary'>".$row['FechaDenuncia']."</p>
                    </div>
                </div>
                <div class='row'>
                    <p class='mb-0'> <strong>Motivo:</strong> ".$row['Motivo']."</p>
                    <p> ".$row['ComentarioDenuncia']." </p>
                </div>
                <hr>";
            }

            echo "<div class='row text-end p-0' style='margin: auto;'>
                <div class='col-6 col-md-8'>
                    <a href='#' class='link'>Ignorar denuncias</a>
                </div>
                <div class='col-6 col-md-4'>
                    <a href='#' class='link'>Eliminar publicación</a>
                </div>
            </div>
        </div>";
        }
    }

    include 'DesconexionBS.php';
?>

<!-- Modelo DIV Denuncia
    <div class='row visual-denuncia p-3 rounded' style='margin: auto; background-color: #ffbfaa;'>
        <div class='row'>
            <h5> Denuncias </h5>
        </div>
        <hr>

        <div class='row'>
            <div class='col-6'>
                <p class='mb-0'><strong>Usuario:</strong> MARTA</p>
            </div>
            <div class='col-6 text-end'>
                <p class='mb-0 text-body-tertiary'>00-00-0000</p>
            </div>
        </div>
        <div class='row'>
            <p class='mb-0'> <strong>Motivo:</strong> No me gusta la publicacion </p>
            <p> Soy el comentario </p>
        </div>
        <hr>

    <div class='row text-end p-0' style='margin: auto;'>
        <div class='col-6 col-md-8'>
            <a href='#' class='link'>Ignorar denuncias</a>
        </div>
        <div class='col-6 col-md-4'>
            <a href='#' class='link'>Eliminar publicación</a>
        </div>
            
    </div>
</div> -->