<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<div id="buscadormobile" class="d-block d-lg-none" style="margin-bottom: 3%;">
    <div class="row">
        <div class="input-group col-mb-3 mx-auto w-75">
            <form class="search d-flex align-items-center w-100" role="search" action="ResultadoBusqueda.php" method="post"  id="formBusque">
                <input class="form-control form-control-sm h-100" type="search" placeholder="Busca una publicación" aria-label="Search" name="busqueda" id="busque">
                    <button class="btn btn-search btn-sm h-100" type="submit">
                        <i class="lupa fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="btn-group ms-2">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-filter-left"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="aplicarFiltro('mostrar_todo')">Ver Todo</a></li>
                            <li><a class="dropdown-item" href="#" onclick="aplicarFiltro('fragil')">Paquete Frágil</a></li>
                            <li><a class="dropdown-item" href="#" onclick="aplicarFiltro('fragilno')">Paquete NO Frágil</a></li>
                        </ul>                   
                    </div>
                    <input type="hidden" name="filtro" id="filtroOcul">
            </form>   
        </div>
    </div>
</div>

</body>
</html>

<script>
    function aplicarFiltro(valor) {
        document.getElementById("filtroOcul").value = valor;
        document.getElementById("formBusque").submit();
    }
</script>