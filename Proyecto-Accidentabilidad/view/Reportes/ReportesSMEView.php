<div class="container-fluid px-4 py-3">

    
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-danger rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-map-signs" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Se&ntilde;al en Mal Estado</h4>
            <p class="text-muted mb-0 small">Reporta se&ntilde;ales viales da&ntilde;adas o en mal estado</p>
        </div>
    </div>

    
    <div class="card border shadow-sm">
        <div class="card-body p-4">

            <form action="<?php echo getUrl('Reportes', 'ReportesSME', 'postCreate');?>"
                  method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="barrio">Barrio</label>
                        <select name="barrio" id="barrio" class="form-control direccion" required>

                        <option value="">Seleccione...</option>
                        
                            <?php while ($barrio = pg_fetch_assoc($barrios)) { ?> 
                                <option value="<?php echo $barrio['id_barrio']; ?>"> 
                                    <?php echo $barrio['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="orientacion">Orientaci&oacute;n</label>
                        <select name="orientacion" id="orientacion" class="form-control"
                        data-url="<?php echo getUrl('Reportes','ReportesSME','getTipoSenal',false,'ajax');?>" required>
                            
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
                        <select id="tipo_via" name="tipo_via" class="form-control" required> 
                            <option value="">Ninguno</option>                
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
                        <input type="number" class="form-control direccion" id="numero1" name="numero1"maxlength="3" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="complemento">Complemento</label>
                        <select class="form-control direccion" id="comp1" name="comp1">
                            <option value="">Ninguno</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                            <option>H</option>
                            <option>I</option>
                            <option>J</option>
                            <option>K</option>
                            <option>L</option>
                            <option>M</option>
                            <option>N</option>
                            <option>O</option>
                            <option>P</option>
                            <option>Q</option>
                            <option>R</option>
                            <option>S</option>
                            <option>T</option>
                            <option>U</option>
                            <option>V</option>
                            <option>W</option>
                            <option>X</option>
                            <option>Y</option>
                            <option>Z</option>
                            <option>Bis</option>
                            <option>Bis A</option>
                            <option>Bis B</option>
                            <option>Bis C</option>
                            <option>Bis D</option>
                            <option>Bis E</option>
                            <option>Bis F</option>
                            <option>Bis G</option>
                            <option>Bis H</option>
                            <option>Bis I</option>
                            <option>Bis J</option>
                            <option>Bis K</option>
                            <option>Bis L</option>
                            <option>Bis M</option>
                            <option>Bis N</option>
                            <option>Bis O</option>
                            <option>Bis P</option>
                            <option>Bis Q</option>
                            <option>Bis R</option>
                            <option>Bis S</option>
                            <option>Bis T</option>
                            <option>Bis U</option>
                            <option>Bis V</option>
                            <option>Bis W</option>
                            <option>Bis X</option>
                            <option>Bis Y</option>
                            <option>Bis Z</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="cuadrante">Cuadrante</label>
                        <select class="form-control direccion" id="cuad1" name="cuad1">
                            <option value=""></option>
                            <option>Norte</option>
                            <option>Sur</option>
                            <option>Oriente</option>
                            <option>Oeste</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="numero2">Número después del #</label>
                        <input type="number" class="form-control direccion" id="numero2" name="numero2" maxlength="3" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="complemento"> Complemento</label>
                        <select class="form-control direccion" id="comp2" name="comp2">
                            <option value="">Ninguno</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                            <option>H</option>
                            <option>I</option>
                            <option>J</option>
                            <option>K</option>
                            <option>L</option>
                            <option>M</option>
                            <option>N</option>
                            <option>O</option>
                            <option>P</option>
                            <option>Q</option>
                            <option>R</option>
                            <option>S</option>
                            <option>T</option>
                            <option>U</option>
                            <option>V</option>
                            <option>W</option>
                            <option>X</option>
                            <option>Y</option>
                            <option>Z</option>
                            <option>Bis</option>
                            <option>Bis A</option>
                            <option>Bis B</option>
                            <option>Bis C</option>
                            <option>Bis D</option>
                            <option>Bis E</option>
                            <option>Bis F</option>
                            <option>Bis G</option>
                            <option>Bis H</option>
                            <option>Bis I</option>
                            <option>Bis J</option>
                            <option>Bis K</option>
                            <option>Bis L</option>
                            <option>Bis M</option>
                            <option>Bis N</option>
                            <option>Bis O</option>
                            <option>Bis P</option>
                            <option>Bis Q</option>
                            <option>Bis R</option>
                            <option>Bis S</option>
                            <option>Bis T</option>
                            <option>Bis U</option>
                            <option>Bis V</option>
                            <option>Bis W</option>
                            <option>Bis X</option>
                            <option>Bis Y</option>
                            <option>Bis Z</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="cuadrante">Cuadrante</label>
                        <select class="form-control direccion" id="cuad2" name="cuad2">
                            <option value="">Ninguno</option>
                            <option>Norte</option>
                            <option>Sur</option>
                            <option>Este</option>
                            <option>Oeste</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="numero3">Número de predio</label>
                        <input type="number" class="form-control direccion" id="numero3" name="numero3" maxlength="3" required>
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion"> Dirección completa</label>
                        <input type="text" class="form-control bg-light" id="direccionPreview" readonly>
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

                        </select>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="tdano">Tipo de da&ntilde;o</label>
                        <select name="tdano" id="tdano" class="form-control" required>

                        <option value="">Seleccione...</option>
                        
                            <?php while ($tdanos = pg_fetch_assoc($tdano)) { ?> 
                                <option value="<?php echo $tdanos['id_tipo_dano_senal']; ?>"> 
                                    <?php echo $tdanos['descripcion']; ?>
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

                        <a href="<?php echo getUrl('Reportes', 'ReportesSME', 'getCreate');?>"
                           class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>