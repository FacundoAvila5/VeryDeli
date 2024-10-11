<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <title>Perfil de usuario</title>
</head>
<body>
    <!-- Nav-->
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

    <div class="container-principal">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                    <img class="rounded-circle me-2" src="img/ala.jpg" alt="" style="width: 40px; height: 40px;">
                    <h2 class="me-2">Avila Facundo</h2>
                    <i class="bi bi-patch-check-fill align-self-center text-success"></i>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <!-- Card de información personal-->
            <div class="card mb-3" style="background-color: #ffffff; border-color: rgb(18, 146, 154);" id="misVehiculos">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10 d-flex">
                            <h2>Información Personal</h2>
                            <i class="bi bi-info-square-fill ms-3 align-self-center"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <i class="bi bi-pencil-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <span>avilafacundo@gmail.com</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <span>2667663225</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-wallet-fill me-2"></i>
                            <span>Mercado pago</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-eye-slash-fill me-2"></i>
                            Contraseña
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de vehiculos-->
            <div class="card mb-3" style="background-color: #ffffff; border-color: rgb(18, 146, 154);">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10 d-flex">
                            <h2>Mis Vehiculos</h2>
                            <i class="bi bi-car-front-fill ms-3 align-self-center"></i>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <i class="bi bi-pencil-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 text-truncate">
                            <span>Automovil Kangoo</span>
                        </div>
                        <div class="col-4 d-flex">
                            <span>50x50x50</span>
                            <i class="bi bi-box-fill ms-2"></i>
                        </div>
                        <div class="col-4 d-flex">
                            <span>200kg</span>
                            <i class="bi bi-box-arrow-down me-2"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-truncate">
                            <span>Motocicleta 200cc</span>
                        </div>
                        <div class="col-4 d-flex">
                            <span>20x20x20</span>
                            <i class="bi bi-box-fill ms-2"></i>
                        </div>
                        <div class="col-4 d-flex">
                            <span>50kg</span>
                            <i class="bi bi-box-arrow-down me-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de verificar cuenta-->
            <div class="card mb-3" style="background-color: #ffffff; border-color: rgb(18, 146, 154)" id="verificarCuenta">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <h2>Verificar Cuenta</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn text-white"style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Verificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


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
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash) {
                setTimeout(function() {
                    const target = document.querySelector(window.location.hash);
                    if (target) {
                        target.scrollIntoView({ behavior: "smooth" });
                    }
                }, 100);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>
</body>
</html>