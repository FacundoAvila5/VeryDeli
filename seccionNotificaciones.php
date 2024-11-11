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
                    <h3>Notificaciones</h3>
                </div>    
                


                <div class="row m-0">
                    <div class="notificaciones col rounded" style="padding: 5px;">
                        <div id="notificaciones">
                        </div> 
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

    <script>
        const idsNotificacionesMostradas = new Set();

        function fetchNotificaciones() {
            fetch('notificaciones.php')
                .then(response => response.json())
                .then(data => {
                    const output = document.getElementById('notificaciones');
                    data.forEach(noti => {
                        if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "Normal") {
                            output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                    onclick="marcarComoVisto(${noti.IdNotificacion}, '${noti.IdPublicacion}')">
                                                    <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                                </div>`;
                        }
                        if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "Envio") {
                            output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                    onclick="enviarDatosCalificacion(${noti.IdNotificacion}, '${noti.IdUsuarioCalificar}')">
                                                    <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                                </div>`;
                        }
                        if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "validacion") {
                            output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                    onclick="enviar()">
                                                    <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                                </div>`;
                        }
                        if (!idsNotificacionesMostradas.has(noti.IdNotificacion) && noti.TipoNotificacion === "verificado") {
                            output.innerHTML += `<div class="notif bg-white rounded text-center border" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                                    onclick="enviarA()">
                                                    <p>${noti.Mensaje} - ${noti.FechaDeNotificacion}</p>
                                                </div>`;
                        }
                        idsNotificacionesMostradas.add(noti.IdNotificacion);
                    });
                })
                .catch(error => console.error('Error al obtener notificaciones:', error));
        }

        function marcarComoVisto(idNotificacion, idPublicacion) {
        const formData = new FormData();
        formData.append('IdNotificacion', idNotificacion);
        
        // Enviar solicitud para cambiar el estado de la notificación
        fetch('notificacion_leida.php', {
            method: 'POST',
            body: formData 
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = `post.php?id=${idPublicacion}`;
            } else {
                console.error('Error al marcar la notificación como vista:', data.message);
            }
        })
        .catch(error => console.error('Error al marcar la notificación como vista:', error));
    }

    function enviarDatosCalificacion(idNotificacion, idUsuarioCalificar) {
        window.location.href = `calificacion.php?IdNotificacion=${idNotificacion}&IdUsuarioCalificar=${idUsuarioCalificar}`;
    }

    function enviar() {
        window.location.href = `VerificarUsuario.php`;
    }

    function enviarA() {
        window.location.href = `perfildeusuario.php`;
    }

        setInterval(fetchNotificaciones, 1000);
    </script>

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>