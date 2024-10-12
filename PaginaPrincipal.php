<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">
        <title>Inicio</title>
</head>

<body>
    <!-- NAV -->
    <nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">
            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="index.html">
                    <img id="logo" src="logos/logo-negro.svg">
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

        <!-- columna: user -->
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
 
        <!-- columna: publicaciones -->
        <div class="publicaciones col-lg-6 col-md-">
            <!-- post -->
            <div class="post card">
                <div class="card-body">
                  <div class="user d-flex justify-content-start">
                      <img class="postUserImg rounded-circle me-2" src="img/1.jpg">
                      Nombre Usuario
                  </div>

                  <div class="postDetails ms-5">
                      <h6 class="card-title">Titulo de publicación</h6>
                      <div class="card-text">
                          <i class="i fa-solid fa-location-dot"></i> Origen: Provincia, Localidad, Barrio <br>
                          <i class="i fa-solid fa-route"></i> Destino: Provincia, Localidad, Barrio <br>
                          <i class="i fa-solid fa-ruler"></i> Volumen: 00 x 00 x 00 <br>
                          <i class="i fa-solid fa-weight-scale"></i> Peso: 00.00kg <br>
                          FRAGIL <br>

                          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                          incididunt ut labore et dolore magna aliqua.
                      </div>
                  </div>
                  
                  <div class="d-flex justify-content-end align-items-center me-3">
                      <a href="post.html" class="link stretched-link">
                          Ver más <i class="fa-solid fa-chevron-right"></i></a>
                  </div>
                </div>

                <div class="card-footer d-flex">
                    <div class="postBottom text-center txt">
                            <i class="fa-solid fa-comments"></i> 0 comentarios
                    </div>
                    <div class="postBottom text-center txt">
                        <i class="fa-solid fa-address-card"></i> 0 postulaciones
                    </div>
                </div>
            </div>
            
        </div>

        <!-- columna: notificaciones -->
        <div class="col-lg-3 col-md-3 col-3 d-none d-lg-block">
            <p class="txt">Notificaciones</p>

            <div class="row">
                <div class="notificaciones col rounded" style="padding: 5px;">
                    <div class="notif bg-white rounded text-center">
                        notif
                    </div>
                    <div class="notif bg-white rounded text-center">
                        notif
                    </div>
                </div>
            </div>
        </div>

      </div>

    </div>

    <!-- BOTTOM NAV -->
    <div class="bNav container-fluid bg-body-tertiary d-block d-lg-none">
      <div class="bNavIcons d-flex">
        <!-- home -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-solid fa-house"></i></a>
        </div>
        <!-- busqueda -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
        <!-- postear -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-regular fa-square-plus"></i></a>
        </div>
        <!-- notifs -->
        <div class="opcionbNav">
            <a href="" class="link"><i class="fa-regular fa-bell"></i></a>
        </div>
        <!-- perfil -->
        <div class="opcionbNav">
            <a href="https://github.com/candazed" class="link"><i class="fa-regular fa-user"></i></a>
        </div>
      </div>
    </div>       

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>