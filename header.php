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
            <div class="col-2">
                <!-- div vacio para centrar. aca podría ir la ubicacion/direccion/etc -->
            </div>

        </div>
    </nav>

    <script>
    function aplicarFilt(valor) {
        document.getElementById("filtroOculto").value = valor;
        document.getElementById("formBusqueda").submit();
    }
</script>

<!-- ACTUALIZACIÓN DE TIPO DE USUARIO -->
<?php
    if (basename($_SERVER['PHP_SELF']) !== 'perfildeusuario.php') {
        include 'actualizar_responsabilidad.php';
    }
?>