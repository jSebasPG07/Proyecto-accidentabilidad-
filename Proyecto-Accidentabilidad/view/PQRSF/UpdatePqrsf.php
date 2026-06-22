<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-danger rounded-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-car-crash" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Registro de pqrsf</h4>
            
        </div>
    </div>

    <div class="card border shadow-sm">
        <div class="card-body p-4">

             <?php 
                $datos = pg_fetch_assoc($reporte);
            ?>

            <form action="<?php echo getUrl("PQRSF","PqrsfC", "postUpdate"); ?>"
                  method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id_pqrsf" value="<?php echo $datos['id_pqrsf']; ?>">

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tpqrsf">Tipo de pqrsf</label>
                        <p class="form-control"><?php echo $datos['tipo_pqrsf'] ?></p>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="mensaje">Mensaje</label>
                        <p class="form-control"><?php echo $datos['mensaje'] ?></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="respuesta">Respuesta</label>
                        <textarea class="form-control" id="respuesta" name="respuesta"rows="3" required></textarea>
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
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Editar PQRSF</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                </div>
            </form>

        </div>
    </div>
</div>