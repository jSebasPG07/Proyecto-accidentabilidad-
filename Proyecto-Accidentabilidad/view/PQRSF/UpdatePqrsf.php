<div class="container-fluid mt-4">

    <?php
        $datos = pg_fetch_assoc($reporte);
    ?>

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">

        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-comments text-white" style="font-size:1.4rem;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Gesti&oacute;n de PQRSF</h4>
            <small class="text-muted">
                Responde y actualiza el estado de la solicitud.
            </small>
        </div>

    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-body p-4">

            <form action="<?php echo getUrl("PQRSF","PqrsfC","postUpdate"); ?>"
                  method="post">

                <input type="hidden" name="id_pqrsf" value="<?php echo $datos['id_pqrsf']; ?>">

                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                <div class="row">

                    <!-- Tipo de PQRSF -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">Tipo de PQRSF</label>
                        <input type="text" class="form-control" value="<?php echo $datos['tipo_pqrsf']; ?>" readonly>

                    </div>

                    <!-- Estado -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">Estado</label>

                        <select name="id_estado" class="form-control" required>

                            <?php while($est = pg_fetch_assoc($estados)){ ?>

                                <option value="<?php echo $est['id_estado']; ?>"

                                    <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>>
                                    <?php echo $est['nombre']; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <!-- Mensaje -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">Mensaje</label>

                        <textarea class="form-control"
                                  rows="4"
                                  readonly><?php echo $datos['mensaje']; ?></textarea>

                    </div>

                    <!-- Respuesta -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">Respuesta</label>
                        <textarea class="form-control" id="respuesta" name="respuesta" rows="4"
                                  placeholder="Escriba la respuesta para el usuario..." required><?php echo $datos['respuesta']; ?></textarea>

                    </div>

                    <!-- Botón -->
                    <div class="col-12">

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane me-2"></i>Guardar respuesta</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>