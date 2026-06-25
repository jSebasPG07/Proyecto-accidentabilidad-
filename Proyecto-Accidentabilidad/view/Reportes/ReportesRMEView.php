<div class="container-fluid px-4 py-3">

    
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

    
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes', 'ReportesRME', 'postCreate'); ?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    
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

                   <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tipovia">Tipo de via</label>
                        <select name="tipo_via" class="form-control" required>
                            <option value="Calle">Calle</option>
                            <option value="Carrera">Carrera</option>
                            <option value="Avenida">Avenida</option>
                            <option value="Avenida Carrera">Avenida Carrera</option>
                            <option value="Avenida Calle">Avenida Calle</option>
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
                    </div

    
                    <div class="col-12 col-md-6">
                        <label>Referencia del lugar</label>
                        <input type="text" name="referencia" class="form-control"
                        placeholder="Ej: Frente a la panadería, junto al poste, cerca al parque" required>
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
                                  placeholder="Describa el estado del reductor, da&ntilde;os visibles o riesgos..." required></textarea>
                    </div>

                    
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                    
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