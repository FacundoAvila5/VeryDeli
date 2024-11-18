<!-- NAV -->
    <nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">

            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="ResultadoBusqueda.php?filtro=mostrar_todo">
                <img id="logo" src="logos/logo-aqua-azul.svg">
                </a>
            </div>
            <!-- searchbar -->
            <div class=" d-flex search-box">
                <div class="form-container input-group search-bar">
                    <form class="d-flex" role="search" action="ResultadoBusqueda.php" method="post" id="formBusqueda">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Busca una publicación" aria-label="Search" name="busqueda" id="busqueda" onfocus="mostrarOpciones()"><br>
                        <button class="btn btn-deli" type="submit">
                            <i class="lupa fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="btn-group mx-2">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-filter-left"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="aplicarFilt('mostrar_todo')">Ver Todo</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="aplicarFilt('fragil')">Paquete Frágil</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="aplicarFilt('fragilno')">Paquete NO Frágil</a></li>
                                </ul>                   
                    </div>
                            <input type="hidden" name="filtro" id="filtroOculto">
                    </form>
                </div>                 
            </div>
            <div class="col-2 text-end pe-3">
                <a href="seccionNotificaciones.php" class="position-relative">
                    <i class="bi bi-bell-fill fs-2" style="color:rgb(13, 44, 85);"></i>
                    <!-- Indicador de notificación rgb(33, 65, 105) rgb(10, 25, 44)-->
                    <span id="notificationIndicator" class="notification-indicator"></span>
                </a>
            </div>


        </div>
    </nav>

    <script>
    function aplicarFilt(valor) {
        document.getElementById("filtroOculto").value = valor;
        document.getElementById("formBusqueda").submit();
    }
</script>

<script>
    const idsNotificacionesMostradas = new Set();
    const notificationIndicator = document.getElementById("notificationIndicator");

    function fetchNotificaciones() {
        fetch('notificaciones.php')
            .then(response => response.json())
            .then(data => {
                let hasNewNotifications = false;
                const output = document.getElementById('notificaciones');

                if (output) {
                    output.innerHTML = ''; 
                }

                data.forEach(noti => {
                    if (!idsNotificacionesMostradas.has(noti.IdNotificacion)) {
                        idsNotificacionesMostradas.add(noti.IdNotificacion);
                    }

                    if (noti.Estado === "0") {
                        hasNewNotifications = true;
                        localStorage.setItem('noti', 'block');
                    }

                    if (output) {
                        if (noti.TipoNotificacion === "Normal") {
                            output.innerHTML += 
                            `<div class="notif bg-white rounded border d-flex flex-column justify-content-center p-2" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                onclick="marcarComoVisto(${noti.IdNotificacion}, '${noti.IdPublicacion}')">
                                <span class="fecha d-flex justify-content-start">${noti.FechaDeNotificacion}</span>    
                                <span>${noti.Mensaje}</span>
                            </div>`;
                        } else if (noti.TipoNotificacion === "Envio") {
                            output.innerHTML += 
                            `<div class="notif bg-white rounded border d-flex flex-column justify-content-center p-2" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                onclick="enviarDatosCalificacion(${noti.IdNotificacion}, '${noti.IdUsuarioCalificar}')">
                                <span class="fecha d-flex justify-content-start">${noti.FechaDeNotificacion}</span>    
                                <span>${noti.Mensaje}</span>
                            </div>`;
                        } else if (noti.TipoNotificacion === "validacion") {
                            output.innerHTML += 
                            `<div class="notif bg-white rounded border d-flex flex-column justify-content-center p-2" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                onclick="enviar()">
                                <span class="fecha d-flex justify-content-start">${noti.FechaDeNotificacion}</span>    
                                <span>${noti.Mensaje}</span>
                            </div>`;
                        } else if (noti.TipoNotificacion === "verificado") {
                            output.innerHTML += 
                            `<div class="notif bg-white rounded border d-flex flex-column justify-content-center p-2" id="busqueda" style="border-color: aqua; cursor: pointer;"
                                onclick="enviarA()">
                                <span class="fecha d-flex justify-content-start">${noti.FechaDeNotificacion}</span>    
                                <span>${noti.Mensaje}</span>
                            </div>`;
                        }
                    }
                });

                notificationIndicator.style.display = hasNewNotifications ? "block" : "none";
            })
            .catch(error => console.error('Error al obtener notificaciones:', error));
    }

    function marcarComoVisto(idNotificacion, idPublicacion) {
        const formData = new FormData();
        formData.append('IdNotificacion', idNotificacion);
        
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

    setInterval(fetchNotificaciones, 100);
</script>


<!-- ACTUALIZACIÓN DE TIPO DE USUARIO -->
<?php
    if (basename($_SERVER['PHP_SELF']) !== 'perfildeusuario.php') {
        include 'actualizar_responsabilidad.php';

        // ELIMINAR NOTIFICACIONES DE CALIFICACION CADUCADAS
        include 'verificar_7DiasCalificacion.php';
    }

?>