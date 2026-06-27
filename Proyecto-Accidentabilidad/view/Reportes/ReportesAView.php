<div class="container-fluid px-4 py-3">
    

    <!-- Encabezado -->
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

            <form action="<?php echo getUrl('Reportes', 'ReportesA', 'postCreate'); ?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">
                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tipovia">Tipo de via</label>
                        <select name="tipo_via" class="form-control" required>                 
                            <option value="Calle">Calle</option>
                            <option value="Carrera">Carrera</option>
                            <option value="Avenida">Avenida</option>
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
                        <label class="form-label fw-semibold" for="tchoque">Tipo de choque</label>
                        <select name="tchoque" id="tchoque" class="form-control" required>

                        <option value="">Seleccione...</option>
                        
                            <?php while ($choque = pg_fetch_assoc($reportes)) { ?> // Se recorren todos los tipos de choque obtenidos de la base de datos.
                                <option value="<?php echo $choque['id_tipo_choque']; ?>"> 
                                    <?php echo $choque['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="nlesionados">N&uacute;mero de lesionados</label>
                        <input type="number" class="form-control" id="nlesionados" name="nlesionados"
                               placeholder="0" min="0" required>
                    </div>

                    
                    <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            <div class="form-text">Opcional. Formatos: JPG, PNG.</div>

                    </div>

                    
                    <div class="col-12 col-md-6">
                         <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>"> //Se guarda el ID del usuario que inició sesión en un campo oculto para enviarlo junto con el formulario.
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones"rows="3" placeholder="Detalles adicionales del accidente..."></textarea>
                    </div>

                    <div class="col-12">
                        <?php include_once "../view/partials/_mapaSelector.php"; ?>
                    </div>

                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Registrar accidente</button>
                        <a href="<?php echo getUrl('Reportes', 'ReportesA', 'getCreate'); ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<?php include_once "../view/partials/script.php"; ?>