<div class="mt-3">
    <h3 class="display-3">Registrar PQRSF</h3>
</div>

<form action="<?php echo getUrl("PQRSF","PqrsfC","postCreate");?>" 
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">


        <div class="col-md-4">
            <label for="tpqrsf">Selecciona el Tipo de pqrsf que desea hacer</label>
            <select name="tpqrsf" id="tpqrsf" class="form-control" required>
                <?php
                    while ($pqrsf = pg_fetch_assoc($tpqrsf)) {
                        echo "<option value='" . $pqrsf['id_tipo_pqrsf'] . "'>" . $pqrsf['nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="observaciones" required></textarea>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-success mt-4">Enviar PQRSF</button>
        </div>

        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        </div>
    </div>
</form>