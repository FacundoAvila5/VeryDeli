<?php $tipouser = $_SESSION['tipoUser']; ?> 
<!-- columna: user -->
<div class="col-lg-3 d-none d-lg-block">
            <!-- info -->
            <a href="perfildeusuario.php" class="link">
                <div class="user d-flex justify-content-start p-2">
                    <img class="userImg rounded-circle me-2" src="<?php $foto = $_SESSION['fotoPerfil']; echo $foto; ?>">
                    <?php
                        $nombre = $_SESSION['usuario'];
                        echo '<span style="font-size: large;">' .$nombre. '</span>';
                    ?>
                </div>
            </a>
            
            <!-- botones justify-content-end-->
            <div class="userBtns d-flex ms-5">
                <!-- publicar -->
                <?php if($tipouser != "Administrador") { ?>
                <div class="row mb-1">
                    <div class="col">
                            <button class="btn btn-small btn-deli btn-publi"
                                data-bs-toggle="modal" data-bs-target="#publicarmodal">
                                <span class="txt"><i class="fa-solid fa-pen-to-square"></i> Publicar</span>
                            </button>
                    </div>
                </div>
                <!-- vehiculos -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="perfildeusuario.php#misVehiculos" class="link"><i class="fa-solid fa-car"></i> Mis vehículos</a>
                    </div>
                </div>
                <!-- actividad -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="historial.php" class="link"><i class="fa-solid fa-clock-rotate-left"></i> Actividad</a>
                    </div>
                </div>
                <!-- verif -->
                <div class="row">
                    <div class="col">
                        <a href="perfildeusuario.php#verificarCuenta" class="link"><i class="fa-solid fa-user-check"></i> Verificar mi cuenta</a>
                    </div>
                </div>
              <?php  } ?>
                 <!-- Verificar usuarios -->
                  
                  <?php
                   if($tipouser == "Administrador"){ ?>
                <div class="row">
                    <div class="col">
                        <a href="VerificarUsuario.php" class="link"><i class="bi bi-patch-check-fill"></i> Verificar Usuarios</a>
                    </div>
                </div>
                <!-- ADMIN: denuncias -->
                <div class="row">
                    <div class="col">
                        <a href="denuncias_admin.php" class="link"><i class='fa-solid fa-triangle-exclamation'></i> Denuncias</a>
                    </div>
                </div>

                <?php }?>
                <hr>
                <!-- cerrar sesion -->
                <div class="row">
                    <div class="col">
                        <a href="CerrarSesion.php" class="link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
                    </div>
                </div>

            </div>

        </div>
