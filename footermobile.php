<div class="bNav container-fluid bg-body-tertiary d-block d-lg-none">
      <div class="bNavIcons d-flex">
        <!-- home -->
        <div class="opcionbNav">
            <a href="PaginaPrincipal.php" class="link"><i class="fa-solid fa-house"></i></a>
        </div>
        <!-- busqueda -->
        <div class="opcionbNav">
            <a href="#buscadormobile" class="link"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
        <!-- postear -->
        <div class="opcionbNav">
            <a href="" class="link" data-bs-toggle="modal" data-bs-target="#publicarmodal"><i class="fa-regular fa-square-plus"></i></a>
        </div>
        <!-- notifs -->
        <div class="opcionbNav" id="btnNotif">
            <!-- <a href="sidebarright.php" class="link"><i class="fa-regular fa-bell"></i></a> -->
             <button class="btn boton" id="btnNotif" ><i class="fa-regular fa-bell"></i></button>
        </div>
        
        <!-- Validaciones -->
        <?php
            $tipouser = $_SESSION['tipoUser'];
            if($tipouser == "Administrador"){ ?>
        <div class="opcionbNav">
            <a href="VerificarUsuario.php" class="link"><i class="bi bi-person-check"></i></a>
        </div>
        <?php } ?>

        <!-- perfil -->
        <div class="opcionbNav">
            <a href="perfildeusuario.php" class="link"><i class="fa-regular fa-user"></i></a>
        </div>
      </div>
    </div>

    <script src="scriptMobile.js"></script>
    