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
                <a class="navbar-brand" href="PaginaPrincipal.php">
                    <img id="logo" src="img/logo-negro.svg" alt="Very Deli: Inicio">
                </a>
            </div>
            <!-- searchbar -->
            <div class=" d-flex search-box">
                <div class="form-container input-group search-bar">
                    <!-- <form class="d-flex" role="search"> -->
                    <input class="form-control " type="search" placeholder="Buscar una publicación" aria-label="Search">
                    <button class="btn btn-search" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
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
    <div class="container-fluid">
      <div class="row p-2">

        <!-- user -->
        <div class="col-lg-3 d-none d-lg-block">
            <!-- info -->
             <a href="perfildeusuario.php" class="link">
                <div class="user d-flex justify-content-start p-2">
                    <img class="userImg rounded-circle me-2" src="img/ala.jpg" alt="">
                    Nombre Usuario
                </div>
             </a>
            <!-- botones -->
            <div class="userBtn d-flex justify-content-end ms-5">
                <!-- publicar -->
                <div class="row">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-pen-to-square"></i> Publicar</a>
                    </div>
                </div>
                <!-- actividad -->
                <div class="row">
                    <div class="col">
                        <a href="#" class="link"><i class="fa-solid fa-clock-rotate-left"></i> Actividad</a>
                    </div>
                </div>
                <!-- vehiculos -->
                <div class="row">
                    <div class="col">
                        <a href="perfildeusuario.php#misVehiculos" class="link"><i class="fa-solid fa-car"></i> Mis vehículos</a>
                    </div>
                </div>
                <!-- verif -->
                <div class="row">
                    <div class="col">
                        <a href="perfildeusuario.php#verificarCuenta" class="link"><i class="fa-solid fa-user-check"></i> Verificar mi cuenta</a>
                    </div>
                </div>
                <br>
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
                <div class="card-body">
                  <div class="user d-flex justify-content-start">
                      <img class="userImgPost rounded-circle me-2" src="img/ala.jpg" alt="">
                      Nombre Usuario
                  </div>

                  <div class="postDetails ms-5">
                      <h6 class="card-title">Titulo de publicación</h6>
                      <div class="card-text">
                          <i class="fa-solid fa-location-dot"></i> Origen: Provincia, Localidad <br>
                          <i class="fa-solid fa-route"></i> Destino: Provincia, Localidad <br>
                          <i class="fa-solid fa-ruler"></i> Volumen: 00 x 00 x 00 <br>
                          <i class="fa-solid fa-weight-scale"></i> Peso: 00.00kg <br>

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
                    <div class="text-center" style="width: 50%;">
                        <a href="#" class="link">
                            <i class="fa-solid fa-comments"></i> 0 comentarios
                        </a>
                    </div>
                    <div class="text-center" style="width: 50%;">
                        <i class="fa-solid fa-address-card"></i> 0 postulaciones
                    </div>
                </div>

            </div>

            <!-- post -->
            <div class="post card">
              <div class="card-body" style="transform: rotate(0);">
                  <div class="user d-flex justify-content-start">
                      <img class="userImgPost rounded-circle me-2" src="img/ala.jpg" alt="">
                      Nombre Usuario
                  </div>
                  <div class="postDetails ms-5">
                      <h6 class="card-title">Titulo de publicación</h6>

                      <h6 class="card-subtitle text-body-secondary mt-2">
                          <i class="fa-solid fa-location-dot"></i> Ubicación
                      </h6>
                      <div class="postText">
                          Origen: Provincia, Localidad <br>
                          Destino: Provincia, Localidad <br>
                      </div>
                      <h6 class="card-subtitle text-body-secondary">
                          <i class="fa-solid fa-ruler"></i> Medidas
                      </h6>
                      <div class="postText">
                          Volumen: 00 x 00 x 00 <br>
                          Peso: 00.00 kg<br>
                      </div>
                      <h6 class="card-subtitle text-body-secondary">
                          <i class="fa-regular fa-note-sticky"></i> Descripción
                      </h6>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                      labore et dolore magna aliqua.
                  </div>
                  <div class="d-flex justify-content-end align-items-center me-3">
                      <a href="https://argentina.gridohelado.com/" class="link stretched-link">
                          Ver más <i class="fa-solid fa-chevron-right"></i></a>
                  </div>
              </div>

              <div class="card-footer d-flex">
                  <div class="text-center" style="width: 50%;">
                      <a href="https://www.pedidosya.com.ar/" class="link">
                          <i class="fa-solid fa-comments"></i> 0 comentarios
                      </a>
                  </div>
                  <div class="text-center" style="width: 50%;">
                      <i class="fa-solid fa-address-card"></i> 0 postulaciones
                  </div>
              </div>

          </div>

            <!-- post -->
            <div class="post bg-white rounded">
                <div class="postInfo">
                    <div class="user d-flex justify-content-start p-2">
                        <img class="userImgPost rounded-circle me-2" src="img/ala.jpg" alt="">
                        Nombre Usuario
                    </div>
                    <span class="txt ms-5">Titulo de publicación</span>
                    <div class="postDetails ms-5">
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            Origen: Provincia, Localidad
                        </span>
                        <br>
                        <span>
                            <i class="fa-solid fa-magnifying-glass-location"></i>
                            <!-- <i class="fa-solid fa-location-pin"></i> -->
                            Destino: Provincia, Localidad</span>
                        <br>
                        <span>
                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                            Volumen: 00 x 00 x 00
                        </span>
                        <br>
                        <span>
                            <i class="fa-solid fa-weight-hanging"></i>
                            Peso: 00.00kg
                        </span>
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </div>
                    <div class="d-flex justify-content-end align-items-center me-3">
                        <a href="" class="link">Ver más <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <hr>
                    other stuff
                </div>
            </div>
        </div>

        <!-- notif -->
        <div class="col-lg-3 col-md-3 col-3 d-none d-lg-block">
            <p class="txt">Notificaciones</p>
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
          <i class="fa-solid fa-user"></i>
        </div>
      </div>
    </div>    

    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>