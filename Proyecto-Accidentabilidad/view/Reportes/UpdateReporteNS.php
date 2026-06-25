<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-plus-circle" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Nueva Se&ntilde;al</h4>
            <p class="text-muted mb-0 small">Solicita la instalaci&oacute;n de una se&ntilde;al vial en tu sector</p>
        </div>
    </div>

    <!-- Card -->
    <div class="card border shadow-sm">
        <div class="card-body p-4">

             <?php 
                $datos = pg_fetch_assoc($reporte);
            ?>

            <form action="<?php echo getUrl('Reportes', 'ReportesNS', 'postUpdate');?>"
                  method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id_sol_nueva_sen" value="<?php echo $datos['id_sol_nueva_sen']; ?>">

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="orientacion">Orientaci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['orientacion'] ?></p>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['direccion'] ?></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">Referencia del lugar</label>
                        <p class="form-control"><?php echo $datos['referencia'] ?></p>
                    </div>


                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tsenal">Tipo de se&ntilde;al</label>
                        <p class="form-control"><?php echo $datos['tipo_senal'] ?></p>
                    </div>

                    
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

                    
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['tipo_senal'] ?></p>
                    </div>

                    <div class="col-md-4">
                        <label for="estado">Estado</label>
                        <select name="id_estado" id="estado" class="form-control" required>
                            <?php while ($est = pg_fetch_assoc($estados)) { ?>
            
                        <option value="<?php echo $est['id_estado']; ?>"
                            <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>>
                
                            <?php echo $est['nombre']; ?>
            
                        </option>

                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar nueva se&ntilde;al</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>