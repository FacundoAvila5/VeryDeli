<div class="modal fade" id="ModalDenuncia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Denunciar publicación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="post.php?id=<?php echo urlencode($_GET['id']); ?>" method="post">
        <div class="modal-body">
                <div class="row w-100">
                    <div class="col-12">
                        <label for="select" class="form-label">Motivo</label>
                        <select id="select" class="form-select" name="selectd">
                            <option value="Politicas de la página" selected>El usuario infrinje las políticas de la página.</option>
                            <option value="Contenido ofensivo">La publicacion me parece ofensiva.</option>
                            <option value="Informacion falsa/robada">La publicacion tiene informacion falsa o robada.</option>
                            <option value="Disgusto">No me gusta ver esta publicacion.</option>
                            <option value="Otro">Otro.</option>
                        </select>
                    </div>
                </div>
                <div class="row pt-4 w-100">
                    <div class="col-12">
                    <div class="form-floating">
                      <textarea class="form-control" id="floatingTextarea" style="height: 100px" name="commentd"></textarea>
                      <label for="floatingTextarea">Comentarios adicionales</label>
                    </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-danger" name="btn-denuncia">Enviar denuncia</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
  // Subida a la BDD
  if (isset($_POST['btn-denuncia'])) {
    extract($_POST);
    include 'ConexionBS.php';
    session_start();
    $idpostd= $_GET['id'];
    $iduser =  $_SESSION['idUser'];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechadenuncia = date('d/m/Y');

    $sql = "INSERT INTO denuncias (IdPublicacion, IdUsuario, Motivo, ComentarioDenuncia, FechaDenuncia) 
            VALUES ('".$idpostd."','".$iduser."','".$selectd."','".$commentd."','".$fechadenuncia."')";
    $result = mysqli_query($conexion, $sql);

    if (!$result) {
      echo "Error: " . mysqli_error($conn);
    }

    include 'DesconexionBS.php';
  }
?>