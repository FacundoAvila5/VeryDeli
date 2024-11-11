<style>
    .opcionbNav .bi-mobile {
    font-size: 1.3rem; /* Ajusta el tamaño del icono */
}
</style>
<?php $tipouser = $_SESSION['tipoUser']; ?> 
<div class="bNav container-fluid bg-body-tertiary d-block d-lg-none">
      <div class="bNavIcons d-flex">
        <!-- home -->
        <div class="opcionbNav">
            <a href="PaginaPrincipal.php" class="link"><i class="bi bi-house bi-mobile txt"></i></a>
        </div>

        <!-- busqueda -->
        <?php if($tipouser != "Administrador") { ?>
        <div class="opcionbNav">
            <a href="PaginaPrincipal.php#buscadormobile" class="link"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
        <!-- postear -->
        <div class="opcionbNav">
            <a href="" class="link" data-bs-toggle="modal" data-bs-target="#publicarmodal"><i class="fa-regular fa-square-plus"></i></a>
        </div>
        <!-- notifs -->
        <div class="opcionbNav" id="btnNotif">
            <button class="btn boton" id="btnNotif" ><i class="fa-regular fa-bell"></i></button>
        </div>
        <?php  } ?>

        <!-- Validaciones -->
        <?php
            if($tipouser == "Administrador"){ ?>
        <div class="opcionbNav">
        </div>
        <div class="opcionbNav">
        </div>
        <div class="opcionbNav">
            <a href="VerificarUsuario.php" class="link"><i class="bi bi-person-check bi-mobile"></i></a>
        </div>
        <?php } ?>


        <!-- perfil -->
        <div class="opcionbNav">
            <a href="perfildeusuario.php" class="link"><i class="fa-regular fa-user"></i></a>
        </div>
      </div>
    </div>

    <script src="scriptMobile.js"></script>
    