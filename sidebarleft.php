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
            <div class="userBtn d-flex ms-5">
                <!-- publicar -->
                <div class="row mb-1">
                    <div class="col">
                        <a href="#" class="link" data-bs-toggle="modal" data-bs-target="#publicarmodal"><i class="fa-solid fa-pen-to-square"></i> Publicar</a>
                        <!-- <button class="btn btn-small btn-publi"><i class="fa-solid fa-pen-to-square"></i> Publicar</button> -->
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
                <hr>
                <!-- cerrar sesion -->
                <div class="row">
                    <div class="col">
                        <a href="CerrarSesion.php" class="link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
                    </div>
                </div>
            </div>

        </div>