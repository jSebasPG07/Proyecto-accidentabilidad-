<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud nueva se&ntilde;al</h3>
</div>

<form action="<?php echo getUrl("Reportes","ReportesNS","postCreate");?>" 
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">
        

        <div class="col-md-4">
            <label for="orientacion">Orientacion</label>
            <select name="orientacion" id="orientacion" class="form-control" required>
                <?php
                    while ($orientacion = pg_fetch_assoc($orientacionn)) {
                        echo "<option value='" . $orientacion['id_orientacion'] . "'>" . $orientacion['nombre'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" required>
        </div>


        <div class="col-md-4">
            <label class="form-label" for="imagen">Inserta una imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
        
        <div class="col-md-4">
            <label for="direccion">Direcci&oacute;n</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="direcci&oacute;n" required>
        </div>



        <div class="col-md-4">
            <label for="tsenal">Tipo se&ntilde;al</label>
            <select name="tsenal" id="tsenal" class="form-control" required>
                <?php
                    while ($tsenall = pg_fetch_assoc($nsenal)) {
                        echo "<option value='" . $tsenall['id_tipo_senal'] . "'>" . $tsenall['nombre_senal'] . "</option>";
                    }
                ?>
            </select>
        </div>

        
        <div class="col-md-4">
            <button type="submit" class="btn btn-success mt-4">Registrar nueva se&ntilde;al </button>
        </div>

        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        </div>

    </div>

</form>

<?php include_once "../view/partials/script.php"; ?>