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

    <title>Preguntas frecuentes</title>
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

    ?>
    <div class="contenedor container-fluid">
        <div class="row">
            <?php
                include 'sidebarleft.php'; 
            ?>

            <div class="mx-auto p-0 col-11 col-md-5 mb-3" > 
                <div class="text-center mx-auto pt-4 pb-2"> 
                    <h4>Preguntas Frecuentes</h4>
                </div>    
                <div id="seccion-faq">
                    <div id="what_responsable" class="pt-1">
                        <h5>¿Qué es un usuario responsable?</h5>
                        Un usuario responsable es aquel que cuente con más de 5 calificaciones que en promedio den una puntuación del 80% o más.
                        Es decir, todo usuario con una puntuación de 4 estrellas (4★) o superior es considerado un usuario responsable. <br>
                    </div>
                    <div id="why_responsable" class="pt-3">
                    <h5>¿Por qué ser un usuario responsable?</h5>
                        Al ser un usuario responsable, podrás publicar y postularte sin limitación alguna. Por el contrario, los usuarios que no cuenten con el nivel de «Responsable»
                        sólo podrán tener un total de <span class="link">3</span> publicaciones activas y <span class="link">1</span> postulación en curso.
                    </div>
                    <div id="how_responsable" class="pt-3">
                        <h5>¿Cómo ser un usuario responsable?</h5>
                        Para alcanzar el nivel de usuario responsable, sólo tienes que obtener 5 calificaciones consecutivas que te otorguen
                        un promedio de puntaje del 80% o más. ¡Es así de simple! 
                    </div>
                    <div id="lost_responsable" class="pt-3">
                        <h5>¿Por qué perdí mi nivel de usuario responsable?</h5>
                        <p>Tu nivel de usuario se verá afectado en todo momento por el promedio de tus calificaciones. Si tu promedio es 
                        menor a 4 estrellas (4★), perderás tu nivel de «Responsable». ¡Intenta ofrecer siempre un buen servicio!</p>
                        Al mismo tiempo, los siguientes eventos harán que pierdas tu nivel de «usuario responsable»:
                        <ul>
                            <li>
                                Cambiar tu nombre en nuestra plataforma. Tenlo en cuenta a la hora de tomar esta decisión.
                            </li>
                            <li>
                                Recibir 2 penalizaciones consecutivas.
                            </li>
                        </ul>
                    </div>
                    <div id="penalizacion" class="pt-2">
                        <h5>¿Por qué he sido penalizado?</h5>
                        Una vez finalizas un envío, o que el postulante a quién hayas elegido finaliza el tuyo, debes calificar tu experiencia con el servicio.
                        Se otorga el tiempo total de <span class="link">una semana</span> para completar esta acción, o de lo contrario 
                        tu cuenta será penalizada con 1 calificación negativa. <br>
                        Las calificaciones negativas no impactan directamente en tu promedio de puntuaciones, pero obtener 
                        2 penalizaciones consecutivas harán que pierdas tu nivel de «Responsable».
                    </div>
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