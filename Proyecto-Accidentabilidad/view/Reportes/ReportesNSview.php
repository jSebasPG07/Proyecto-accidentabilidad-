<div class="container-fluid px-4 py-3">

    
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-map-signs" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Nueva Se&ntilde;al</h4>
            <p class="text-muted mb-0 small">Solicita la instalaci&oacute;n de una se&ntilde;al vial en tu sector</p>
        </div>
    </div>

    
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes', 'ReportesNS', 'postCreate');?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="orientacion">Orientaci&oacute;n</label>
                        <select name="orientacion" id="orientacion" class="form-control" required>
                            
                        <option value="">Seleccione...</option>

                            <?php while ($orientacion = pg_fetch_assoc($orientacionn)) { ?>
                                <option value="<?php echo $orientacion['id_orientacion']; ?>">
                                    <?php echo $orientacion['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tipovia">Tipo de via</label>
                        <select name="tipo_via" class="form-control" required>
                            <option value="Calle">Calle</option>
                            <option value="Carrera">Carrera</option>
                            <option value="Diagonal">Diagonal</option>
                            <option value="Transversal">Transversal</option>
                            <option value="Circular">Circular</option>
                        </select>
                    </div>

    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="numero1">N&uacute;mero de via</label>
                        <input type="text" name="numero1" class="form-control" required>
                    </div>

    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="caracter">N&uacute;mero despues de #</label>
                        <input type="text" name="numero2" class="form-control" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">N&uacute;mero de predio</label>
                        <input type="text" name="numero3" class="form-control"required>
                    </div>

    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="referencia"> Referencia del lugar</label>
                        <input type="text" name="referencia" class="form-control"
                        placeholder="Ej: Frente a la panader&iacute;a, junto al poste, cerca al parque" required>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tsenal">Tipo de se&ntilde;al</label>
                        <select name="tsenal" id="tsenal" class="form-control" required>

                        <option value="">Seleccione...</option>
                        
                            <?php while ($tsenall = pg_fetch_assoc($nsenal)) { ?>
                                <option value="<?php echo $tsenall['id_tipo_senal']; ?>">
                                    <?php echo $tsenall['nombre_senal']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">

                        <div class="form-text">
                            Opcional. Formatos: JPG, PNG.
                        </div>
                    </div>

                
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                  placeholder="Describe la necesidad de la nueva se&ntilde;al, el riesgo existente o cualquier detalle relevante..." required></textarea>
                    </div>

                    
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                    <div class="col-12">
                        <?php include_once "../view/partials/_mapaSelector.php"; ?>
                    </div>
                    
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar nueva se&ntilde;al</button>

                        <a href="<?php echo getUrl('Reportes', 'ReportesNS', 'getCreate'); ?>"
                           class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>