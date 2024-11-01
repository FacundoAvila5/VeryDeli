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
    <style>
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
    include "ConexionBS.php";

    include 'header.php';

    include "CrearPublicacion.php";
    
    $user= $_SESSION["idUser"];

    $consulta = "SELECT d.IdPublicacion, p.Titulo, d.FechaDenuncia AS Fecha
                FROM denuncias d
                JOIN publicaciones p ON d.IdPublicacion=p.IdPublicacion";

    $resultado = mysqli_query($conexion, $consulta); 

    ?>
    <div class="row">
        <?php
            include 'sidebarleft.php'; 
        ?>

        <div class="mx-auto p-0 col-11 col-md-5" > 
            <div class="text-center justify-content-center mx-auto pt-4 pb-3"> 
                <h2>Denuncias</h2>
            </div>    
            <div id="seccion-historial">

                <?php

                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()) {
                            echo "<a href='post.php?id=" . urlencode($row['IdPublicacion']) . "'> <div id='historia' class='row bg-light pt-2 pb-0 ps-3 mb-2' style='border-radius: 15px;'>
                                    <div class='col-1'> <i class='fa-solid fa-bookmark' style='color:rgb(7, 64, 113);'></i> </div>    
                                        <div class='col-8 col-md-9'> 
                                            <p> Publicacion denunciada: ". $row['Titulo'] ." </p> 
                                        </div>
                                        <div class='col-3 col-md-2'> 
                                            <p class='text-black-50 text-end' id='fecha' style='font-size: small'> ". $row['Fecha'] ." </p> 
                                        </div> 
                                    </div> 
                                </a>";
                        }
                    } else { //Si no hay nada
                        echo "<p class='text-center'> <strong>No hay denuncias!</strong> </p>";
                    }

                ?>

                <!-- Formato:
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
</body>
</html>