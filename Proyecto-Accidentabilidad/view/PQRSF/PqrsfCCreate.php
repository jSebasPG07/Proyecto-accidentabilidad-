<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-clipboard-list" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Registro de pqrsf</h4>
            
        </div>
    </div>

    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl("PQRSF","PqrsfC", "postCreate"); ?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tpqrsf">Selecciona el Tipo de pqrsf que desea hacer</label>
                        <select name="tpqrsf" id="tpqrsf" class="form-control" required>
                         <?php
                            while ($pqrsf = pg_fetch_assoc($tpqrsff)) {
                                echo "<option value='" . $pqrsf['id_tipo_pqrsf'] . "'>" . $pqrsf['nombre'] . "</option>";
                            }
                            ?>
                       </select>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="mensaje">mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje"rows="3" required></textarea>
                    </div>

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Registrar PQRSF</button>
                        <a href="<?php echo getUrl("PQRSF","PqrsfC", "getCreate"); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                </div>
            </form>

        </div>
    </div>
</div>











