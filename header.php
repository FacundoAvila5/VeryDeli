<!-- NAV -->
<nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">
            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="PaginaPrincipal.php">
                    <img id="logo" src="logos/logo-negro.svg">
                </a>
            </div>
            <!-- searchbar -->
            <div class=" d-flex search-box">
                <div class="form-container input-group search-bar">
                    <form class="d-flex" role="search" action="ResultadoBusqueda.php" method="post">
                    <input class="form-control" type="search" placeholder="Busca una publicación" aria-label="Search" name="busqueda">
                    <button class="btn btn-search" type="submit">
                        <i class="lupa fa-solid fa-magnifying-glass"></i>
                    </button>
                    </form>
                </div>
            </div>

            <div class="col-2">
                <!-- div vacio para centrar. aca podría ir la ubicacion/direccion/etc -->
            </div>

        </div>
    </nav>