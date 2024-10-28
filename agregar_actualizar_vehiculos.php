<!-- Modal para Agregar/Actualizar Vehículos -->
<div class="modal fade" id="vehiculoModal" tabindex="-1" aria-labelledby="vehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehiculoModalLabel">Agregar o Actualizar Vehículos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="w-75" method="POST" action="guardar_modificar_vehiculo.php" novalidate>
                    <?php for ($i = 0; $i < 2; $i++): ?>
                        <div class="mb-3">
                            <h6>Vehículo <?php echo $i + 1; ?><?php echo $i === 1 ? ' (opcional)' : ''; ?></h6>
                            <input type="hidden" name="vehiculos[<?php echo $i; ?>][IdVehiculo]" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['IdVehiculo'] : ''; ?>">

                            <label for="marca<?php echo $i; ?>" class="form-label">Marca</label>
                            <input type="text" class="form-control mb-3" id="marca<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Marca]" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Marca'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa la marca del vehículo.</div>

                            <label for="modelo<?php echo $i; ?>" class="form-label">Modelo</label>
                            <input type="text" class="form-control mb-3" id="modelo<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Modelo]" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Modelo'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa el modelo del vehículo.</div>

                            <label for="alto<?php echo $i; ?>" class="form-label">Alto del lugar donde guardara los paquetes</label>
                            <input type="text" class="form-control mb-3" id="alto<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Alto]" pattern="^\d+([.,]\d+)?$" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Alto'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa un alto válido (número con coma o punto).</div>

                            <label for="ancho<?php echo $i; ?>" class="form-label">Ancho del lugar donde guardara los paquetes</label>
                            <input type="text" class="form-control mb-3" id="ancho<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Ancho]" pattern="^\d+([.,]\d+)?$" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Ancho'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa un ancho válido (número con coma o punto).</div>

                            <label for="largo<?php echo $i; ?>" class="form-label">Largo del lugar donde guardara los paquetes</label>
                            <input type="text" class="form-control mb-3" id="largo<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Largo]" pattern="^\d+([.,]\d+)?$" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Largo'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa un largo válido (número con coma o punto).</div>

                            <label for="capacidad<?php echo $i; ?>" class="form-label">Capacidad de Peso</label>
                            <input type="text" class="form-control mb-3" id="capacidad<?php echo $i; ?>" name="vehiculos[<?php echo $i; ?>][Capacidad_Peso]" pattern="^\d+([.,]\d+)?$" value="<?php echo isset($vehiculos[$i]) ? $vehiculos[$i]['Capacidad_Peso'] : ''; ?>">
                            <div class="invalid-feedback">Por favor, ingresa una capacidad de peso válida (número con coma o punto).</div>
                        </div>
                        <?php if ($i === 0): ?>
                            <div class="my-5" style="height: 5px; background: linear-gradient(to right, transparent, rgb(18, 146, 154), transparent);"></div>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <button type="submit" class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Guardar Vehículos</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Validation Script -->
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('form');

        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                let valid = true;

                for (let i = 0; i < 2; i++) {
                    const marca = form['vehiculos[' + i + '][Marca]'].value.trim();
                    const modelo = form['vehiculos[' + i + '][Modelo]'].value.trim();
                    const alto = form['vehiculos[' + i + '][Alto]'].value.trim();
                    const ancho = form['vehiculos[' + i + '][Ancho]'].value.trim();
                    const largo = form['vehiculos[' + i + '][Largo]'].value.trim();
                    const capacidad = form['vehiculos[' + i + '][Capacidad_Peso]'].value.trim();

                    if (marca || modelo || alto || ancho || largo || capacidad) {
                        if (!marca) {
                            valid = false;
                            form['vehiculos[' + i + '][Marca]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Marca]'].classList.remove('is-invalid');
                        }

                        if (!modelo) {
                            valid = false;
                            form['vehiculos[' + i + '][Modelo]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Modelo]'].classList.remove('is-invalid');
                        }

                        if (alto && !/^\d+([.,]\d+)?$/.test(alto)) {
                            valid = false;
                            form['vehiculos[' + i + '][Alto]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Alto]'].classList.remove('is-invalid');
                        }

                        if (ancho && !/^\d+([.,]\d+)?$/.test(ancho)) {
                            valid = false;
                            form['vehiculos[' + i + '][Ancho]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Ancho]'].classList.remove('is-invalid');
                        }

                        if (largo && !/^\d+([.,]\d+)?$/.test(largo)) {
                            valid = false;
                            form['vehiculos[' + i + '][Largo]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Largo]'].classList.remove('is-invalid');
                        }

                        if (capacidad && !/^\d+([.,]\d+)?$/.test(capacidad)) {
                            valid = false;
                            form['vehiculos[' + i + '][Capacidad_Peso]'].classList.add('is-invalid');
                        } else {
                            form['vehiculos[' + i + '][Capacidad_Peso]'].classList.remove('is-invalid');
                        }
                    }
                }

                if (!valid) {
                    event.preventDefault();
                    event.stopPropagation();
                }

            
            }, false);
        });
    })();
</script>
