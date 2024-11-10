<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .contenedor {
            flex-grow: 1;
        }
        .mx-auto {
            max-width: 100%;
        }
        a {
            text-decoration:none;
            color: black;
        }
    </style>

    <title>VeryDeli</title>
</head>
<body>
    <?php 

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
    
    include "ConexionBS.php";

    include 'header.php';

    include "CrearPublicacion.php";
    
    $user= $_SESSION["idUser"];

    $con_pub = "SELECT 'publicacion' AS tipo, IdPublicacion AS Id, IdUsuario, FechaPublicacion AS Fecha, Titulo, IdPublicacion 
    FROM publicaciones 
    WHERE IdUsuario = '".$user."' ";
    $con_post = "SELECT 'postulacion' AS tipo, p.IdPostulacion AS Id, p.IdUsuarioPostulacion AS IdUsuario, p.FechaPostulacion AS Fecha, pp.Titulo, pp.IdPublicacion 
                FROM postulaciones p 
                JOIN publicaciones pp ON p.IdPublicacion = pp.IdPublicacion
                WHERE p.IdUsuarioPostulacion = '".$user."' ";


    // tipo / Id / IdUsuario / Fecha / Titulo(publicacion)
    $con_historial = "($con_pub) UNION ($con_post) ORDER BY Fecha DESC"; 

    $resultado = mysqli_query($conexion, $con_historial); 

    ?>
    <div class="contenedor container-fluid">
        <div class="row">
            <?php
                include 'sidebarleft.php'; 
            ?>

            <div class="mx-auto p-0 col-11 col-md-5" > 
                <div class="text-center justify-content-center mx-auto pt-4 pb-3"> 
                    <h2>Historial de actividad</h2>
                </div>    
                <div id="seccion-historial">

                    <?php

                        if ($resultado->num_rows > 0) { //Si hay postulaciones o publicaciones
                            while($row = $resultado->fetch_assoc()) {
                                echo "<a href='post.php?id=" . urlencode($row['IdPublicacion']) . "'> <div id='historia' class='row bg-light pt-2 pb-0 ps-3 mb-2' style='border-radius: 15px;'>
                                        <div class='col-1'> <i class='fa-solid fa-bookmark' style='color:rgb(7, 64, 113);'></i> </div>    
                                            <div class='col-8 col-md-9'> ";
                                if ($row['tipo'] == 'publicacion') {
                                    echo "<p> Realizaste la publicación: ". $row['Titulo'] ." </p> </div>";
                                } else {
                                    echo "<p> Te postulaste en la publicación: ". $row['Titulo'] ." </p> </div>";
                                }
                                echo "<div class='col-3 col-md-2'> <p class='text-black-50 text-end' id='fecha' style='font-size: small'> ". $row['Fecha'] ." </p> </div> 
                                </div> </a>";
                            }
                        } else { //Si no hay nada
                            echo "<p class='text-center'> <strong>No hay registros!</strong> </p>";
                        }

                    ?>

                    <!-- Formato historia:
                    <div id="historia" class="row bg-light pt-2 pb-0 ps-3 mb-2" style="border-radius: 15px;">
                        <div class="col-1"> <i class="fa-solid fa-bookmark" style="color:rgb(7, 64, 113);"></i> </div>    
                        <div class="col-8 col-md-9"> <p> Yo iguall </p> </div>
                        <div class="col-3 col-md-2"> <p class="text-black-50 text-end" id="fecha"> 00/00/00 </p> </div> 
                    </div> -->
                </div>
            </div>

                <div class="col-lg-3 d-none d-lg-block">
                    <!-- Div para centrar o notificaciones -->
                </div>
        </div>
    </div> 
    <div>
       <?php include 'PiedePagina.php'; ?>
    </div>
    

    <?php


    include 'footermobile.php';

    include "DesconexionBS.php";
    ?>

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>