<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">

        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-comments text-white" style="font-size:1.4rem;"></i>
        </div>

        <div>
            
            <h4 class="mb-0 fw-bold">Registro de PQRSF</h4>
            <small class="text-muted">Registra una petici&oacute;n, queja, reclamo, sugerencia o felicitaci&oacute;n.</small>

        </div>

    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-body p-4">

            <form action="<?php echo getUrl("PQRSF","PqrsfC","postCreate"); ?>"
                  method="post"
                  enctype="multipart/form-data">

                <div class="row">

                    <!-- Tipo -->
                    <div class="col-md-7 mb-4">

                        <label class="form-label fw-bold">Tipo de PQRSF</label>

                        <select
                            name="tpqrsf"
                            id="tpqrsf"
                            class="form-control"
                            required>

                            <?php
                            while($pqrsf = pg_fetch_assoc($tpqrsff)){
                                echo "<option value='".$pqrsf['id_tipo_pqrsf']."'>".$pqrsf['nombre']."</option>";
                            }
                            ?>

                        </select>

                    </div>

                    <!-- Mensaje -->
                    <div class="col-md-7 mb-4">

                        <label class="form-label fw-bold">Mensaje</label>

                        <textarea
                            class="form-control"
                            id="mensaje"
                            name="mensaje"
                            rows="5"
                            placeholder="Escriba aqu&iacute; el detalle de su solicitud..."
                            required></textarea>

                    </div>

                    <input type="hidden"
                           name="id"
                           value="<?php echo $_SESSION['id']; ?>">

                    <!-- Botones -->
                    <div class="col-12">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fas fa-paper-plane me-2"></i>
                            Registrar PQRSF

                        </button>

                        <a
                            href="<?php echo getUrl("PQRSF","PqrsfC","getCreate"); ?>"
                            class="btn btn-outline-secondary ms-2">
                            Cancelar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>