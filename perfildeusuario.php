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

<?php
    session_start();
    include "ConexionBS.php";
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
    
    $idUsuario = $_SESSION["idUser"];
    if (isset($_SESSION['mensaje'])) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' style='position: fixed; bottom: 20px; right: 20px; z-index: 1050;'>
            " . $_SESSION['mensaje'] . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        unset($_SESSION['mensaje']);
    }

    // Consulta para la información del usuario
    $sqlUsuario = "SELECT * FROM usuarios WHERE IdUsuario = $idUsuario";
    $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);
    $usuario = mysqli_fetch_assoc($resultadoUsuario);

    // Consulta para los vehículos del usuario
    $sqlVehiculos = "SELECT *
    FROM vehiculos
    WHERE Id_Usuario = $idUsuario";
    $resultadoVehiculos = mysqli_query($conexion, $sqlVehiculos);
    $vehiculos = mysqli_fetch_all($resultadoVehiculos, MYSQLI_ASSOC);
    include 'modificarinformacionpersonal.php';
    include 'agregar_actualizar_vehiculos.php';
    include 'cambiar_contraseña.php';

    //consulta para ver si esta en pedido de revision o no y asi permitir o no pedir validacion de nuevo

    $usid = $_SESSION["idUser"]; 
    $consultarevision = "SELECT *
                        FROM validaciones
                        WHERE IdUsuarioValidacion = $usid";
    $usuariopedido = mysqli_query($conexion, $consultarevision);
    while($row = mysqli_fetch_assoc($usuariopedido)){
        $estadoconsulta = $row['Estado'];
    }

?>
<?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <?php echo $_GET['mensaje']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <?php echo $_GET['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<body>
    <!-- HEADER -->
    <?php
    include 'MensajeExito.php';
    include 'header.php';
    include "CrearPublicacion.php";
    ?>

    <!-- <div class="container-principal"> -->
    <div class="contenedor container-fluid">
        <div class="container w-50">
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                    <img class="rounded-circle me-2" src="<?php echo $usuario['ImagenUsuario'] ?>" alt="" style="width: 40px; height: 40px;">
                    <h2 class="me-2"><?php echo $usuario['NombreUsuario'] . " " . $usuario['ApellidoUsuario']; ?></h2>
                    <?php
                        if ($usuario['Validado'] == 1) {
                            echo '<i class="bi bi-patch-check-fill align-self-center text-success"></i>';      
                        }
                    ?>
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
                            <i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#editPersonalInfoModal" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <span><?php echo $usuario['EmailUsuario'] ?></span>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <span><?php echo $usuario['TelefonoUsuario'] ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center">
                            <button class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);" data-bs-toggle="modal" data-bs-target="#cambiarContraseña">
                            <i class="bi bi-eye-slash-fill"> </i>Cambiar Contraseña</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de vehículos-->
            <div class="card mb-3" style="background-color: #ffffff; border-color: rgb(18, 146, 154);">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10 d-flex">
                            <h2>Mis Vehículos</h2>
                            <i class="bi bi-car-front-fill ms-3 align-self-center"></i>
                        </div>
                        <!-- Ícono del lápiz que abre el modal -->
                        <div class="col-2 d-flex justify-content-end">
                            <i class="bi bi-pencil-fill" data-bs-toggle="modal" data-bs-target="#vehiculoModal" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (count($vehiculos) > 0): ?>
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <div class="row mb-3">
                                <div class="col-3 col-md-5 text-truncate">
                                    <span><?php echo $vehiculo['Marca'] . " " . $vehiculo['Modelo']; ?></span>
                                </div>
                                <div class="col-5 col-md-3 d-flex">
                                    <span><?php echo $vehiculo['Alto'] . "x" . $vehiculo['Ancho'] . "x" . $vehiculo['Largo']; ?></span>
                                    <i class="bi bi-box-fill ms-2"></i>
                                </div>
                                <div class="col-2 col-md-3 d-flex">
                                    <span><?php echo $vehiculo['Capacidad_Peso']; ?></span>
                                    <i class="bi bi-box-arrow-down ms-1"></i>
                                </div>
                                <!-- Enlace para eliminar el vehículo -->
                                <div class="col-2 col-md-1 d-flex justify-content-end">
                                    <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                    data-id="<?php echo $vehiculo['IdVehiculo']; ?>" id="deleteVehicle">
                                        <i class="bi bi-trash-fill" style="color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);"></i>
                                    </a>
                                </div>

                                <!-- Modal de Confirmación -->
                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que quieres eliminar este vehículo?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12 text-center">
                                <span>No tiene ningún vehículo cargado.</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>                        

          <?php  if($estadoconsulta != 'En revision' && $usuario['Validado'] == 0 ){ ?>
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
                            <button class="btn text-white link"style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);" data-bs-toggle="modal" data-bs-target="#validarUser">Verificar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

             <!-- Card de ver historial -->           
            <div class="card mb-3 d-lg-none" style="background-color: #ffffff; border-color: rgb(18, 146, 154)" id="verificarCuenta">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <h2>Ver Actividad</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a class="btn text-white link"style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);" href="historial.php">Ir a actividad</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de cerrar sesion-->
            <div class="card mb-3 d-lg-none" style="background-color: #ffffff; border-color: rgb(18, 146, 154); width: 50%; margin:auto;" id="verificarCuenta">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                        <a href="CerrarSesion.php" class="link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a><br>      
                        </div>
                    </div>
                </div>
            </div>           

        </div>
        <?php include 'PiedePagina.php'; ?>
    </div>

    <!-- FOOTER MOBILE -->
    <?php 
        include 'footermobile.php';
    ?>

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
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteVehicleLink = document.getElementById('deleteVehicle');
            const confirmDeleteButton = document.getElementById('confirmDelete');

            deleteVehicleLink.addEventListener('click', function(event) {
                const vehicleId = event.target.closest('a').dataset.id;
                confirmDeleteButton.dataset.id = vehicleId;
            });

            confirmDeleteButton.addEventListener('click', function() {
                const vehicleId = this.dataset.id;
                window.location.href = 'eliminar_vehiculo.php?id=' + vehicleId;
            });
        });
    </script>

  <?php include "formularioVerificarCuenta.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0ce357c188.js" crossorigin="anonymous"></script>

</body>
</html>