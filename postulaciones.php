<div id="postulaciones" class="d-none">
    <!-- <div class="mb-1">
        <div class="row m-2">
            <div class="col d-flex align-items-center justify-content-center">
                <span class="txt">POSTULACIONES</span>
            </div>
        </div>
    </div> -->

    <?php
    if($idusu == $post['IdUsuario']){
        $sql = "SELECT p.*, u.NombreUsuario, u.ApellidoUsuario, u.ImagenUsuario, u.Validado
        FROM postulaciones p
        INNER JOIN usuarios u ON p.IdUsuarioPostulacion = u.IdUsuario
        ORDER BY FechaPostulacion";
        $postulaciones = mysqli_query($conexion, $sql);
        $date='';

        while ($pst = mysqli_fetch_assoc($postulaciones)) {
            if($pst['IdPublicacion'] == $idpost){

                if($date == ''){
                    $date = $pst['FechaPostulacion'];
                }
                else if ($date != $pst['FechaPostulacion']){
                    $date = $pst['FechaPostulacion'];
                }
        ?>
            <span class="fecha"><?php echo $pst['FechaPostulacion']; ?></span>
            <hr style="margin-top: 0.2rem;">

    <div class="comment bg-white mb-3">
        <div class="row m-2 p-2">
            <div class="col-1 d-flex align-items-center justify-content-start p-0">
                <img class="postUserImg rounded-circle" src="<?php echo $pst['ImagenUsuario']; ?>">
            </div>
            <div class="col-9 d-flex flex-column align-items-start">
                <div class="row">
                    <div class="col-12">
                        <span>
                            <span class="txt"><?php echo $pst['NombreUsuario'] ." ". $pst['ApellidoUsuario']; ?></span>
                            <?php
                                if ($pst['Validado'] == 1) {
                                    echo ' <i class="bi bi-patch-check-fill align-self-center text-success"></i>';      
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- <span class="text-secondary">Monto: <span class="txt">$<?php //echo $pst['Monto']; ?></span></span> -->
                        <span class="">Monto: $<?php echo $pst['Monto']; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="text-secondary">Comentario: <?php echo $pst['ComentarioPostulacion']; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-end">
                <button class="btn btn-deli">Elegir</button>
            </div>
        </div>
    </div>
    <?php
            } //if
        } //while
    } //if
    ?>
</div>