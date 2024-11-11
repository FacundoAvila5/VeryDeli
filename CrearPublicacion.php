<!-- Modal para publicar -->
<div class="modal fade" id="publicarmodal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
    <?php 
        $idusu = $_SESSION['idUser'];

        //CONTROLES PARA USUARIOS NO RESPONSABLESS

        //nivel del usuario
        ($_SESSION['tipoUser']=='Responsable') ? $responsable = true : $responsable = false;

        $testt = $_SESSION['tipoUser'];
        echo "<script> console.log('Post| tipo: ". $testt. " - state: ". $responsable ."') </script>";

        // publicaciones activas
        $sql = "SELECT Estado
                FROM publicaciones
                WHERE IdUsuario = $idusu AND Estado = 'Activa'";
        $estado = mysqli_query($conexion, $sql);
        (mysqli_num_rows($estado) >= 3) ? $postLimit = true : $postLimit = false;
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="publishModalLabel">Publicar necesidad de envio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <?php if(!$responsable && $postLimit){ ?>
                <div class="alert alert-danger mb-2" role="alert">
                    Alcanzaste el límite de <strong>3</strong> publicaciones activas para tu nivel de usuario.
                    Para más información haz <a href="preguntasFrecuentes.php" class="alert-link">click aquí</a>.
                </div>
                <?php } ?>

            <form id="publicacion" action="guardarPublicacion.php" method="post" class="needs-validation" novalidate>
                
            <div class="mb-3">
                <label for="tituloPubli" class="form-label">Título de la publicación</label>
                <input type="text" class="form-control" id="tituloPubli" name="tituloPubli" placeholder="Título*" minlength="5" required>
                <div class="invalid-feedback">
                    El título de la publicación es obligatorio (mínimo 3 caracteres)
                </div>
            </div>

            <div class="mb-3">
                <label for="origenPubli" class="form-label"><i class="fa-solid fa-location-dot"></i> Desde</label><br>

                <div class="row">
                    <div class="col-md-6">
                        <label for="provinciaorigen" class="form-label"> Provincia</label>
                        <input type="text" class="form-control" id="provinciaorigen" name="provinciaorigen" placeholder="Provincia*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la provincia de origen (mínimo 3 caracteres)
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="Localidadorigen" class="form-label">Localidad</label>
                        <input type="text" class="form-control" id="Localidadorigen" name="Localidadorigen" placeholder="Localidad*" minlength="3" required>  
                        <div class="invalid-feedback">
                            Por favor, ingrese la localidad de origen (mínimo 3 caracteres)
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="barrioorigen" class="form-label"> Barrio</label>
                        <input type="text" class="form-control" id="barrioorigen" name="barrioorigen" placeholder="Barrio*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el barrio de origen (mínimo 3 caracteres)
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="direccionorigen" class="form-label"> Dirección</label>
                        <input type="text" class="form-control" id="direccionorigen" name="direccionorigen" placeholder="Dirección de calle*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la dirección de origen (mínimo 3 caracteres)
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="destinoPubli" class="form-label"><i class="fa-solid fa-location-dot"></i> Hasta</label><br>

                <div class="row">
                    <div class="col-md-6">
                        <label for="provinciadestino" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="provinciadestino" name="provinciadestino" placeholder="Provincia*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la provincia de destino (mínimo 3 caracteres)
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="Localidaddestino" class="form-label"> Localidad</label>
                        <input type="text" class="form-control" id="Localidaddestino" name="Localidaddestino" placeholder="Localidad*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese la localidad de destino (mínimo 3 caracteres)
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="barriodestino" class="form-label"> Barrio</label>
                        <input type="text" class="form-control" id="barriodestino" name="barriodestino" placeholder="Barrio*" minlength="3" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el barrio de destino (mínimo 3 caracteres)
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="direcciondestino" class="form-label"> Dirección</label>
                        <input type="text" class="form-control" id="direcciondestino" name="direcciondestino" placeholder="Dirección de calle*" minlength="3" required>    
                        <div class="invalid-feedback">
                            Por favor, ingrese la dirección de destino (mínimo 3 caracteres)
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="fechaLimite" class="form-label">Fecha Limite</label>
                <input type="date" class="form-control" id="fechaLimite" name="fechaLimite" placeholder="Fecha" required>
                <div class="invalid-feedback">
                    Por favor, ingrese una fecha límite
                </div>
            </div>

        <div class="mb-3">
            <label for="medidas" class="form-label"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Medidas del paquete</label>
            <div class="row">
                <div class="col-6">
                    <input type="number" class="form-control" id="alto" name="alto" placeholder="Alto (cm)*" min="1" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la altura del paquete (mayor a cero 0)
                    </div>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" id="ancho" name="ancho" placeholder="Ancho (cm)*" min="1" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el ancho del paquete (mayor a cero 0)
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <input type="number" class="form-control" id="largo" name="largo" placeholder="Largo (cm)*" min="1" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el largo del paquete (mayor a cero 0)
                    </div>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" id="peso" name="peso" placeholder="Peso (gr)*" min="1" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el peso del paquete (mayor a cero 0)
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">¿Es frágil?</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fragil" id="fragilSi" value="sí" required>
                    <label class="form-check-label" for="fragilSi">Sí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="fragil" id="fragilNo" value="no" required>
                    <label class="form-check-label" for="fragilNo">No</label>
                </div>
                <div class="invalid-feedback">
                    Por favor, seleccione si el paquete es frágil
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            <div class="invalid-feedback">
                Por favor, ingrese una descripción
            </div>
        </div><hr>
        <div class="mb-3">
        <label for="descripcion" class="form-label"><h5>Datos del remitente</h5></label>
        </div>
        <div class="mb-3">
            <label for="nombreremitente" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreremitente" name="nombreremitente" placeholder="Nombre del remitente*" minlength="3" required>
            <div class="invalid-feedback">
                Por favor, ingrese un nombre (mínimo 3 caracteres)
            </div>
        </div>

        <div class="mb-3">
            <label for="celular" class="form-label">Número de celular</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular*" minlength="10" maxlength="10" required>
            <div class="invalid-feedback">
                Por favor, ingrese un número de celular (10 caracteres)
            </div>
        </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="publicacion" class="btn text-white <?php echo ($postLimit && !$responsable) ? 'disabled' : ''; ?>" 
                style="background-color: rgb(18, 146, 154);" id="btnPublicar">Publicar</button>
        </div>
        </div>
    </div>
</div>

<!-- Script de Bootstrap para mensaje de error en formulario -->
<script>
    // btnPublicar = document.getElementById('btnPublicar')

  (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>