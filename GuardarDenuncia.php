<?php 
  // Subida a la BDD
  if (isset($_POST['btn-denuncia'])) {
    extract($_POST);
    include 'ConexionBS.php';
    session_start();
    // $idpostd= $_GET['id'];
    $iduser =  $_SESSION['idUser'];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechadenuncia = date('d/m/Y');

    $sql = "INSERT INTO denuncias (IdPublicacion, IdUsuario, Motivo, ComentarioDenuncia, FechaDenuncia) 
            VALUES ('".$idpostd."','".$iduser."','".$selectd."','".$commentd."','".$fechadenuncia."')";
    $result = mysqli_query($conexion, $sql);

    include 'DesconexionBS.php';

    header("Location: post.php?id= ".$idpostd);
  }
?>