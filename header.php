<style>
#Mostrartodo {
    background-color: rgb(178, 176, 176);
    color: black; 
    padding: 7px 16px; 
    font-size: 14px; 
    cursor: pointer; 
}
#opcionesBusqueda{
    border: none;
    border-radius: 50px;
}
</style>
<!-- NAV -->
    <nav class="navbar bg-body-tertiary d-none d-lg-block">
        <div class="container-fluid d-flex justify-content-between">
            <!-- logo -->
            <div class="col-2 ms-5">
                <a class="navbar-brand" href="PaginaPrincipal.php">
                    <img id="logo" src="logos/logo-aqua-azul.svg">
                    <!-- <img id="logo" src="logos/logo-aqua.svg"> -->
                </a>
            </div>
            <!-- searchbar -->
            <div class="d-flex search-box">
                <div class="form-container input-group search-bar buscador">
                    <form class="d-flex" role="search" action="ResultadoBusqueda.php" method="post">
                        <div class="input-group">
                        <input class="form-control" type="search" placeholder="Busca una publicación" aria-label="Search" name="busqueda" id="busqueda" onfocus="mostrarOpciones()">
                        <!-- <br> -->
                        <button class="btn btn-search" type="submit">
                            <i class="lupa fa-solid fa-magnifying-glass"></i>
                        </button>
                        </div>
                        <div class="col-10" id="opcionesBusqueda" style="display: none; position: absolute; top: 100%; background-color: white; border: 1px solid #ccc; z-index: 1;">
                            <button class="btn" type="submit" name="mostrar_todo" value="true" style="width: 100%;" id="Mostrartodo">
                                Mostrar Todo
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
