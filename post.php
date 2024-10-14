<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    <!-- NAV  -->
    <nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">
            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="index.html">
                    <img id="logo" src="img/logo-negro.svg" alt="Very Deli: Inicio">
                </a>
            </div>
            <!-- searchbar -->
            <div class=" d-flex search-box">
                <div class="form-container input-group search-bar">
                    <!-- <form class="d-flex" role="search"> -->
                    <input class="form-control" type="search" placeholder="Buscar una publicación" aria-label="Search">
                    <button class="btn btn-search" type="submit">
                        <i class="lupa fa-solid fa-magnifying-glass"></i>
                    </button>
                    <!-- </form> -->
                </div>
            </div>

            <div class="col-2">
                <!-- div vacio para centrar. aca podría ir la ubicacion/direccion/etc -->
            </div>

        </div>
    </nav>
    <!-- CONTENIDO -->
    <div class="contenedor container-fluid">
      <div class="row p-2 pt-3">

        <!-- user -->
        <div class="col-lg-3 d-none d-lg-block">
            <!-- info -->
            <div class="user d-flex justify-content-start p-2">
                <img class="userImg rounded-circle me-2" src="img/1.jpg">
                Nombre Usuario
            </div>
            <!-- botones justify-content-end-->
            <div class="userBtn d-flex ms-5">
                <!-- publicar -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-pen-to-square"></i> Publicar</a>
                        <!-- <button class="btn btn-small btn-publi"><i class="fa-solid fa-pen-to-square"></i> Publicar</button> -->
                    </div>
                </div>
                <!-- vehiculos -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-car"></i> Mis vehículos</a>
                    </div>
                </div>
                <!-- actividad -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-clock-rotate-left"></i> Actividad</a>
                    </div>
                </div>
                <!-- verif -->
                <div class="row">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-user-check"></i> Verificar mi cuenta</a>
                    </div>
                </div>
                <hr>
                <!-- cerrar sesion -->
                <div class="row">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- publicaciones -->
        <div class="publicaciones col-lg-6 col-md-">
            <!-- post -->
            <div class="post card">
                <div class="card-header bg-transparent" style="padding: 3px;">
                    <div class="row" style="margin: auto;">
                        <!-- volver -->
                        <div class="col p-0">
                            <div class="d-flex ">
                                <div class="btnVolver rounded d-flex justify-content-center align-items-center">
                                    <a class="link" href="PaginaPrincipal.php"><i class="fa-solid fa-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="row" style="margin: auto;">
                        <!-- USER INFO -->
                        <div class="col-10 p-0">
                            <img class="postUserImg rounded-circle me-2" src="img/1.jpg">
                            <span class="txt">Nombre Usuario</span>
                        </div>
                        <!-- POST LINKS -->
                        <div class="col p-0 d-flex justify-content-end">
                            <div class="btn-group dropstart">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <!-- *** EL BOTON QUE SE MUESTRA DEPENDE DEL USUARIO ACTIVO -->
                                    <li>
                                        <a href="" class="dropdown-item redLink"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item redLink"><i class="fa-regular fa-flag"></i> Denunciar</a>
                                    </li>
                                </ul>
                            </div>  
                        </div>  
                    </div>

                    <div class="row">
                        <div class="postDetails ms-5 col">
                            <h6 class="card-title" >Titulo de publicación</h6> <!-- style="margin-top: 8px;"-->
                                <i class="fa-solid fa-location-dot"></i> Origen: Provincia, Localidad <br>
                                <i class="fa-solid fa-route"></i> Destino: Provincia, Localidad <br>
                                <i class="fa-solid fa-ruler"></i> Volumen <br>
                                Longitud: 00 <br>
                                Ancho: 00 <br>
                                Alto: 00 <br>
                                <i class="fa-solid fa-weight-scale"></i> Peso: 00.00kg <br>

                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center me-3">
                        <button class="btn btn-light">Postularme</button>
                    </div>
                </div>

                <div class="card-footer d-flex">
                    <div class="text-center" style="width: 50%;">
                        <i class="fa-solid fa-comments"></i> 0 comentarios
                    </div>
                    <div class="text-center" style="width: 50%;">
                        <i class="fa-solid fa-address-card"></i> 0 postulaciones
                    </div>
                </div>

            </div>

            <!-- comentarios -->
            <div class="comentarios">
                <!-- *** PREGUNTA = no es dueño de la publi -->
                <div class="comment bg-white">
                    <div class="row p-2 mb-3">
                        <div class="col-1 d-flex justify-content-start">
                            <img class="postUserImg rounded-circle" src="img/2.jpg">
                        </div>
                        <div class="col-11 d-flex align-items-center">
                            <input type="text" class="cInput form-control" placeholder="Escribe aquí tu pregunta"></input>
                            <button class="btn"><i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
                <!-- *** PREGUNTA YA PUBLICADA -->
                <div class="comment bg-white">
                    <div class="row p-2 mb-3">
                        <div class="col-1 d-flex justify-content-start">
                            <img class="postUserImg rounded-circle" src="img/2.jpg">
                        </div>
                        <div class="col-11 d-flex align-items-center">
                            ¿Soy una pregunta?
                        </div>
                    </div>
                </div>
                <!-- *** RESPUESTA = si es dueño de la publi -->
                <div class="respuesta row mb-3">
                    <div class="col-1"></div>
                    <div class="col">
                        <div class="comment bg-white">
                            <div class="row p-2">
                                <!-- <div class="col-1"></div> -->
                                <div class="col-1 d-flex justify-content-start">
                                    <img class="postUserImg rounded-circle" src="img/1.jpg">
                                </div>
                                <div class="col-11 d-flex align-items-center">
                                    <input type="text" class="cInput form-control" placeholder="Escribe aquí tu respuesta"></input>
                                    <button class="btn"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>

        <!-- notif -->
        <div class="col-lg-3 col-md-3 col-3 d-none d-lg-block">
            <p class="txt">Notificaciones</p>

            <div class="row">
                <div class="col rounded" style="padding: 5px;">
                    <div class="bg-white rounded text-center" style="margin: 10px 2px;">
                        notif
                    </div>
                    <div class="bg-white rounded text-center" style="margin: 10px 2px;">
                        notif
                    </div>
                    <div class="bg-white rounded text-center" style="margin: 10px 2px;">
                        notif
                    </div>
                </div>
            </div>
        </div>

      </div>

    </div>

    <!-- BOTTOM NAV -->
    <div class="bottomNavbar container-fluid bg-body-tertiary d-block d-lg-none">
      <div class="navIcons d-flex">
        <!-- home -->
        <div class="opcionMenu">
          <i class="fa-solid fa-house"></i>
        </div>
        <!-- busqueda -->
        <div class="opcionMenu">
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <!-- postear -->
        <div class="opcionMenu">
          <i class="fa-solid fa-square-plus"></i>
        </div>
        <!-- idk -->
        <div class="opcionMenu">
          <i class="fa-solid fa-face-smile"></i>
        </div>
        <!-- perfil -->
        <div class="opcionMenu">
            <a href="https://github.com/candazed"><i class="fa-solid fa-user"></i></a>
        </div>
      </div>
    </div>    

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>