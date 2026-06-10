<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud Vía En Mal Estado</h3>
</div>

<form action="<?php echo getUrl('Reportes', 'SolicitudVME', 'postCreate'); ?>"
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="idtipodanovia">Tipo de daño</label>
            <select name="idtipodanovia" id="idtipodanovia" class="form-control">
                <?php while ($dano = pg_fetch_assoc($tiposDanoVia)) { ?>
                    <option value="<?php echo $dano['id_tipo_dano_via']; ?>">
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

        <div class="col-md-4">
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>

        <div class="col-md-4 mt-3">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"
                      rows="3" placeholder="Describa el estado de la vía"></textarea>
        </div>

        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-success">Enviar solicitud</button>
        </div>
        
        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        </div>

    </div>

</form>


