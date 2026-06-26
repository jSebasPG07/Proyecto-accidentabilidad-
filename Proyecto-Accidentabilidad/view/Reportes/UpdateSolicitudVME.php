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
                        <p class="form-control"><?php echo $datos['tipo_dano_via'] ?></p>
                    </div>

                    <!-- Dirección -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['direccion'] ?></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="referencia">Referencia</label>
                        <p class="form-control"><?php echo $datos['referencia'] ?></p>
                    </div>

                    <!-- Imagen -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <div>
                            <?php if($datos['imagen_url'] != ""){ ?>
                                <img src="<?php echo $datos['imagen_url']; ?>" width="120">
                            <?php } else { ?>
                                <p class="form-control">Sin imagen</p>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['descripcion'] ?></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Estado</label>
                        <select name="id_estado" id="estado" class="form-control" required>
                            <?php while ($est = pg_fetch_assoc($estados)) { ?>
            
                        <option value="<?php echo $est['id_estado']; ?>"
                            <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>>
                
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

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>