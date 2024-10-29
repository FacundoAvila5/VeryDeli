<style>

#opcionesBusqueda {
    background-color: rgb(245, 244, 244) !important;
    width: 84%; 
    border-radius: 5% !important;
    position: absolute;
    z-index: 3;
}

#Mostrartodo {
    background-color: transparent !important;
    color: black;
    padding: 7px 16px;
    font-size: 14px;
    cursor: pointer;
    text-align: left;
    z-index: 4 !important;
    position: relative;
}


</style>
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
                    <input class="form-control" type="search" placeholder="Busca una publicación" aria-label="Search" name="busqueda" id="busqueda" onfocus="mostrarOpciones()"><br>
                    <button class="btn btn-search" type="submit">
                        <i class="lupa fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div id="opcionesBusqueda" style="display: none; position: absolute; top: 100%; border: 1px solid #ccc;">
                        <button class="btn btn-search" type="submit" name="mostrar_todo" value="true" style="width: 100%;" id="Mostrartodo">
                            Mostrar Todo
                        </button>
                        <button class="btn btn-search" type="submit" name="fragil" value="true" style="width: 100%;" id="Mostrartodo">
                            Frágil
                        </button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-2">
                <!-- div vacio para centrar. aca podría ir la ubicacion/direccion/etc -->
            </div>

        </div>
    </nav>

    <script>
    function mostrarOpciones() {
        var opciones = document.getElementById('opcionesBusqueda');
        opciones.style.display = 'block';
    }

    //Oculta las opciones al hacer clic fuera del campo de busqueda
    document.addEventListener('click', function(event) {
        var clickDentro = document.getElementById('busqueda').contains(event.target);
        var clickBusq = document.getElementById('opcionesBusqueda').contains(event.target);

        if (!clickDentro && !clickBusq) {
            document.getElementById('opcionesBusqueda').style.display = 'none';
        }
    });
    </script>
