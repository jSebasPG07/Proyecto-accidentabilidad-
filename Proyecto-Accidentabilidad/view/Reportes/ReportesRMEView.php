<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-road" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Reductor en Mal Estado</h4>
            <p class="text-muted mb-0 small">Reporta da&ntilde;os en reductores de velocidad en la v&iacute;a</p>
        </div>
    </div>

    <!-- Card -->
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes', 'ReportesRME', 'postCreate'); ?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- Tipo de reductor -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="idtipored">Tipo de reductor</label>
                        <select name="idtipored" id="idtipored" class="form-control" required>
                            <?php while ($red = pg_fetch_assoc($tiposReductor)) { ?>
                                <option value="<?php echo $red['id_tipo_reductor']; ?>">
                                    <?php echo $red['categoria'] . ' - ' . $red['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Tipo de daño -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="idtipodanoreductor">Tipo de da&ntilde;o</label>
                        <select name="idtipodanoreductor" id="idtipodanoreductor" class="form-control" required>
                            <?php while ($dano = pg_fetch_assoc($tiposDanoReductor)) { ?>
                                <option value="<?php echo $dano['id_tipo_dano_reductor']; ?>">
                                    <?php echo $dano['descripcion']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Dirección -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                               placeholder="Ej: Cra 5 # 12-30" required>
                    </div>

                    <!-- Imagen -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">

                        <div class="form-text">
                            Opcional. Formatos: JPG, PNG.
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                  placeholder="Describa el estado del reductor, da&ntilde;os visibles o riesgos..." required></textarea>
                    </div>

                    <!-- Hidden -->
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                    <!-- Botones -->
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane me-2"></i>Enviar solicitud</button>

                        <a href="<?php echo getUrl('Reportes', 'ReportesRME', 'getCreate'); ?>"
                           class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>