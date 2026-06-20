<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-road" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Nuevo Reductor</h4>
            <p class="text-muted mb-0 small">Registra la solicitud de instalaci&oacute;n de un nuevo reductor de velocidad</p>
        </div>
    </div>

    <!-- Card -->
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes','ReportesSolicitudNR','postCreate');?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- Tipo de Reductor -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="id_tipo_reductor">Tipo de Reductor</label>
                        <select name="id_tipo_reductor" id="id_tipo_reductor" class="form-control" required>

                            <option value="">Seleccione...</option>

                            <?php
                                while($reductor = pg_fetch_assoc($reductores)){
                                    echo "<option value='".$reductor['id_tipo_reductor']."'>".$reductor['nombre']."</option>";
                                }
                            ?>

                        </select>
                    </div>

                    <!-- Tipo de Daño -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="id_tipo_dano_reductor">Clasificaci&oacute;n / Da&ntilde;o</label>
                        <select name="id_tipo_dano_reductor" id="id_tipo_dano_reductor" class="form-control" required>

                            <option value="">Seleccione...</option>

                            <?php
                                while($dano = pg_fetch_assoc($danos)){
                                    echo "<option value='".$dano['id_tipo_dano_reductor']."'>".$dano['descripcion']."</option>";
                                }
                            ?>

                        </select>
                    </div>

                    <!-- Dirección -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ej: Cra 5 # 12-30" required>
                    </div>

                    <!-- Imagen -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">

                        <div class="form-text">
                            Opcional. Formatos: JPG, PNG.
                        </div>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"rows="3"
                                  placeholder="Describe la solicitud del reductor, necesidad o riesgo..." required></textarea>
                    </div>

                    <!-- Hidden -->
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                    <!-- Botones -->
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar nuevo reductor</button>

                        <a href="<?php echo getUrl('Reportes','ReportesSolicitudNR','getCreate');?>"
                           class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>