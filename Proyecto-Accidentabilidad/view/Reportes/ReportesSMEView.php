<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud señal en mal estado</h3>
</div>

<form action="<?php echo getUrl("Reportes","ReportesSME","postCreate");?>" 
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">


        <div class="col-md-4">
            <label for="orientacion">Orientacion</label>
            <input type="text" class="form-control" id="orientacion" name="orientacion" placeholder="orientacion" required>
        </div>

        <div class="col-md-4">
            <label for="descripcion">Descripcion</label>
            <input type="number" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" min="0" required>
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
            <label for="tsenal">Tipo señal</label>
            <select name="tsenal" id="tsenal" class="form-control" required>
                <?php
                    while ($tsenall = pg_fetch_assoc($nsenal)) {
                        echo "<option value='" . $tsenall['id_tipo_senal'] . "'>" . $tsenall['nombre_senal'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="tdaño">Tipo daño</label>
            <select name="tdaño" id="tdaño" class="form-control" required>
                     <?php
                        while ($tdaños = pg_fetch_assoc($tdaño)) {
                            echo "<option value='" . $tdaños['id_tipo_dano_senal'] . "'>" . $tdaños['descripcion'] . "</option>";
                         }
                    ?>
            </select>
        </div>


        
        <div class="col-md-4">
            <button type="submit" class="btn btn-success mt-4">Registrar solicitud señal mal estado</button>
        </div>

    </div>

</form>

<?php include_once "../view/partials/script.php"; ?>