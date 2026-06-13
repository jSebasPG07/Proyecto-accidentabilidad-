<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud Nuevo Reductor</h3>
</div>

<form action="<?php echo getUrl("Reportes","ReportesSolicitudNR","postCreate");?>"
      method="post"
      enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="id_tipo_reductor">Tipo de Reductor</label>
            <select name="id_tipo_reductor"
                    id="id_tipo_reductor"
                    class="form-control"
                    required>

                <option value="">Seleccione...</option>

                <?php
                    while($reductor = pg_fetch_assoc($reductores)){
                        echo "<option value='".$reductor['id_tipo_reductor']."'>".$reductor['nombre']."</option>";
                    }
                ?>

            </select>
        </div>

        <div class="col-md-4">
            <label for="id_tipo_dano_reductor">Clasificaci&oacute;n / Da&ntilde;o</label>

            <select name="id_tipo_dano_reductor"
                    id="id_tipo_dano_reductor"
                    class="form-control"
                    required>

                <option value="">Seleccione...</option>

                <?php
                    while($dano = pg_fetch_assoc($danos)){
                        echo "<option value='".$dano['id_tipo_dano_reductor']."'>".$dano['descripcion']."</option>";
                    }
                ?>

            </select>
        </div>

        <div class="col-md-4">
            <label for="direccion">Direcci&oacute;n</label>
            <input type="text"
                   class="form-control"
                   id="direccion"
                   name="direccion"
                   placeholder="Direcci&oacute;n"
                   required>
        </div>

        <div class="col-md-4 mt-3">
            <label for="descripcion">Descripci&oacute;n</label>
            <textarea class="form-control"
                      id="descripcion"
                      name="descripcion"
                      rows="3"
                      required></textarea>
        </div>

        <div class="col-md-4 mt-3">
            <label for="imagen_url">Fotograf&iacute;a de Evidencia</label>
            <input type="file"
                   class="form-control"
                   id="imagen_url"
                   name="imagen_url"
                   accept="image/*"
                   required>
        </div>

        <div class="col-md-4 mt-3">
            <button type="submit"
                    class="btn btn-success mt-4">
                Enviar Solicitud
            </button>
        </div>
        
        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        </div>

    </div>

</form>

<?php include_once "../view/partials/script.php"; ?>
