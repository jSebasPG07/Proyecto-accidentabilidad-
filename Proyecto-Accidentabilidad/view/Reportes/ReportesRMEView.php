<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud Reductor En Mal Estado</h3>
</div>

<form action="<?php echo getUrl('Reportes', 'ReportesRME', 'postCreate'); ?>"
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="idtipored">Tipo de reductor</label>
            <select name="idtipored" id="idtipored" class="form-control">
                <?php while ($red = pg_fetch_assoc($tiposReductor)) { ?>
                    <option value="<?php echo $red['id_tipo_reductor']; ?>">
                        <?php echo $red['categoria'] . ' - ' . $red['nombre']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="idtipodanoreductor">Tipo de daño</label>
            <select name="idtipodanoreductor" id="idtipodanoreductor" class="form-control">
                <?php while ($dano = pg_fetch_assoc($tiposDanoReductor)) { ?>
                    <option value="<?php echo $dano['id_tipo_dano_reductor']; ?>">
                        <?php echo $dano['descripcion']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion"
                   placeholder="Ej: Cra 5 # 12-30">
        </div>

        <div class="col-md-4 mt-3">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"
                      rows="3" placeholder="Describa el estado del reductor"></textarea>
        </div>

        <div class="col-md-4 mt-3">
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>

        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-success">Enviar solicitud</button>
        </div>

    </div>

</form>
