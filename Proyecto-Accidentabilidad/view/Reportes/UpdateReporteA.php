<div class="container-fluid px-4 py-3">

    
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-danger rounded-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-car-crash" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Reporte de Accidente</h4>
            <p class="text-muted mb-0 small">Registra la informaci&oacute;n del siniestro vial ocurrido</p>
        </div>
    </div>

    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <?php 
                $datos = pg_fetch_assoc($reporte);
            ?>

            <form action="<?php echo getUrl('Reportes', 'ReportesA', 'postUpdate'); ?>"
                  method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id_reporte_acc" value="<?php echo $datos['id_reporte_acc']; ?>">

                <div class="row g-3">


                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['direccion'] ?></p>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tchoque">Tipo de choque</label>
                        <p class="form-control"><?php echo $datos['tipo_choque'] ?></p>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="nlesionados">N&uacute;mero de lesionados</label>
                        <p class="form-control"><?php echo $datos['num_lesionados'] ?></p>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <div>
                            <?php if($datos['imagen_url'] != ""){ ?> // Se verifica si el reporte tiene una imagen registrada.
                                <img src="<?php echo $datos['imagen_url']; ?>" width="120"> <!-- Si existe una imagen, se muestra en pantalla. -->
                            <?php } else { ?>
                                <p class="form-control">Sin imagen</p>
                            <?php } ?>
                        </div>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="observaciones">Observaciones</label>
                        <p class="form-control"><?php echo $datos['observaciones'] ?></p>
                    </div>

                    <div class="col-md-4">
                        <label for="estado">Estado</label>
                        <select name="id_estado" id="estado" class="form-control" required>
                            <?php while ($est = pg_fetch_assoc($estados)) { ?> // Se recorren todos los estados de la base de datos.

                              <!-- Se crea una opción por cada estado y, si corresponde al estado actual del reporte, se marca como seleccionada. -->
                        <option value="<?php echo $est['id_estado']; ?>" 
                            <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>>
                
                            <?php echo $est['nombre']; ?>
            
                        </option>

                            <?php } ?>
                        </select>
                    </div>


                    
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Editar accidente</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                </div>
            </form>

        </div>
    </div>
</div>

<?php include_once "../view/partials/script.php"; ?>