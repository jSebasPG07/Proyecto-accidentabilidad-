<div class="container-fluid px-4 py-3">

    
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-danger rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-route" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud V&iacute;a en Mal Estado</h4>
            <p class="text-muted mb-0 small">Reporta da&ntilde;os o deterioros en la infraestructura vial</p>
        </div>
    </div>

   
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes', 'SolicitudVME', 'postCreate'); ?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="idtipodanovia">Tipo de da&ntilde;o</label>
                        <select name="idtipodanovia" id="idtipodanovia" class="form-control" required>

                            <option value="">Seleccione...</option>

                            <?php
                                while ($dano = pg_fetch_assoc($tiposDanoVia)) {
                                    echo "<option value='" . $dano['id_tipo_dano_via'] . "'>" . $dano['descripcion'] . "</option>";
                                }
                            ?>

                        </select>
                    </div>

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
                        <label class="form-label fw-semibold" for="referencia"> Referencia del lugar</label>
                        <input type="text" name="referencia" class="form-control"
                        placeholder="Ej: Frente a la panader&iacute;a, junto al poste, cerca al parque" required>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="imagen">Evidencia fotogr&aacute;fica</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">

                        <div class="form-text">
                            Opcional. Formatos: JPG, PNG.
                        </div>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Describe el estado de la se&ntilde;al" required></textarea>
                    </div>

                    <div class="col-12">
                        <?php include_once "../view/partials/_mapaSelector.php"; ?>
                    </div>
                    
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane me-2"></i>Enviar solicitud</button>

                        <a href="<?php echo getUrl('Reportes','SolicitudVME','getCreate'); ?>"
                           class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>