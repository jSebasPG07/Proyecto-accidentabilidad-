<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-road" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud V&iacute;a en Mal Estado</h4>
            <p class="text-muted mb-0 small">Reporta da&ntilde;os o deterioros en la infraestructura vial</p>
        </div>
    </div>

    <!-- Card -->
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <?php 
                $datos = pg_fetch_assoc($reporte);
            ?>

            <form action="<?php echo getUrl('Reportes', 'SolicitudVME', 'postUpdate'); ?>"
                  method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id_sol_via_mal" value="<?php echo $datos['id_sol_via_mal']; ?>">

                <div class="row g-3">

                    <!-- Tipo de daño -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="idtipodanovia">Tipo de da&ntilde;o</label>
                        <p class="form-control"><?php echo $datos['tipo_dano_via'] ?></p> <!-- Se muestra el tipo de daño de la vía registrado en la solicitud. -->
                    </div>

                    <!-- Dirección -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['direccion'] ?></p> <!-- Se muestra la dirección registrada en la solicitud. -->
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="referencia">Referencia</label>
                        <p class="form-control"><?php echo $datos['referencia'] ?></p> <!-- Se muestra la referencia registrada en la solicitud. -->
                    </div>

                    <!-- Imagen -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <div>
                            <?php if($datos['imagen_url'] != ""){ ?> // Se verifica si la solicitud tiene una imagen registrada.
                                <img src="<?php echo $datos['imagen_url']; ?>" width="120"> <!-- Si existe una imagen, se muestra en pantalla. -->
                            <?php } else { ?>
                                <p class="form-control">Sin imagen</p> //Si no hay imagen
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['descripcion'] ?></p> <!-- Se muestra la descripción registrada en la solicitud. -->
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Estado</label>
                        <select name="id_estado" id="estado" class="form-control" required>
                            <?php while ($est = pg_fetch_assoc($estados)) { ?> <!-- Se recorren todos los estados de la base de datos. -->
            
                        <option value="<?php echo $est['id_estado']; ?>"
                            <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>> <!-- Marca como seleccionado el estado actual de la solicitud. -->
                
                            <?php echo $est['nombre']; ?>
            
                        </option>

                            <?php } ?>
                        </select>
                    </div>
                    <!-- Botones -->
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane me-2"></i>Editar solicitud</button>

                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>"> <!-- Se envía el ID del usuario que inició sesión junto con el formulario. -->

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>