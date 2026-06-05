<div class="mt-3">
    <h3 class="display-3">Formulario reportes accidentes</h3>
</div>

<form action="<?php echo getUrl("Reportes","ReportesA","postCreate");?>" 
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="fechaaccidente">Fecha del accidente</label>
            <input type="date" class="form-control" id="fechaaccidente" name="fechaaccidente" required>
        </div>

        <div class="col-md-4">
            <label for="nomenclatura">Nomenclatura</label>
            <input type="text" class="form-control" id="nomenclatura" name="nomenclatura" placeholder="nomenclatura" required>
        </div>

        <div class="col-md-4">
            <label for="nlesionados">Número de lesionados</label>
            <input type="number" class="form-control" id="nlesionados" name="nlesionados" placeholder="número de lesionados" min="0" required>
        </div>

        <div class="col-md-4">
            <label for="observaciones">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="observaciones"></textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label" for="imagen">Inserta una imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
        
        <div class="col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="dirección" required>
        </div>

        <div class="col-md-4">
            <label for="tchoque">Tipo de Choque</label>
            <select name="tchoque" id="tchoque" class="form-control" required>
                <?php
                    while ($choque = pg_fetch_assoc($reportes)) {
                        echo "<option value='" . $choque['id_tipo_choque'] . "'>" . $choque['nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="col-md-4">
            <button type="submit" class="btn btn-success mt-4">Registrar accidente</button>
        </div>

    </div>

</form>

<?php include_once "../view/partials/script.php"; ?>