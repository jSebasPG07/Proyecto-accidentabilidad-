<div class="mt-3">
    <h3 class="display-3">Formulario reportes accidentes</h3>
</div>

<form action="<?php echo getUrl("Reportes","Reportes","postCreate");?>" 
      method="post" enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="fechaaccidente">fecha del accidente</label>
            <input type="text" class="form-control" id="usuario" name="fechaaccidente" placeholder="fecha del accidente">
        </div>

        <div class="col-md-4">
            <label for="nomenclaura">Nomenclatura</label>
            <input type="text" class="form-control" id="usuario" name="nomenclatura" placeholder="nomenclatura">
        </div>

        <div class="col-md-4">
            <label for="nlesionados">Numero</label>
            <input type="number" class="form-control" id="usuario" name="nlesionados" placeholder="numero de lesionados">
        </div>

        <div class="col-md-4">
            <label for="observaciones">Obervaciones </label>
            <textarea id="usuario" name="observaciones" rows="3" cols="40" placeholder="observaciones"> </textarea>
        </div>

        <div class="col-md-4">
            <div class="col-md-4">
            <label class="form-label"> Inserta una imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" >
        </div>
        </div>
        
         <div class="col-md-4">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="usuario" name="direccion" placeholder="direccion">
        </div>

        <div class="col-md-4">
            <label for="tchoque">Choque</label>
            <select name="tchoque" id="tchoque" class="form-control">
                <?php
                    while ($choque = pg_fetch_assoc($reportes)) {
                        echo "<option value='" . $choque['id_tipo_choque'] . "'>" . $choque['nombre_choque'] . "</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="col-md-4">
            <button type="submit" class="btn btn-success mt-4">Registrar accidente</button>
        </div>

    </div>

</form>