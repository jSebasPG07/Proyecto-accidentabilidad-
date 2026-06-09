<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud Nuevo Reductor</h3>
</div>

<form action="<?php echo getUrl("Reportes","ReportesSolicitudNR","postCreate");?>"
      method="post"
      enctype="multipart/form-data">

    <div class="row mt-5">

        <div class="col-md-4">
            <label for="id_tipo_reductor">Tipo de Reductor</label>
            <select name="id_tipo_reductor" id="id_tipo_reductor" class="form-control" required>
                <option value="">Seleccione...</option>
                <option value="1">Resalto Parabólico</option>
                <option value="2">Banda Sonora</option>
                <option value="3">Stoper / Tachón</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="id_tipo_dano_reductor">Clasificación / Daño</label>
            <select name="id_tipo_dano_reductor"
            id="id_tipo_dano_reductor"
            class="form-control"
            required>

            <option value="">Seleccione...</option>
            <option value="1">Deformado</option>
            <option value="2">Partido</option>
            <option value="3">Suelto</option>
            <option value="4">Desplazado</option>

        </select>
        </div>

        <div class="col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text"
                   class="form-control"
                   id="direccion"
                   name="direccion"
                   placeholder="Dirección"
                   required>
        </div>

        <div class="col-md-4">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control"
                      id="descripcion"
                      name="descripcion"
                      rows="3"
                      required></textarea>
        </div>

        <div class="col-md-4">
            <label for="imagen_url">Fotografía de Evidencia</label>
            <input type="file"
                   class="form-control"
                   id="imagen_url"
                   name="imagen_url"
                   accept="image/*"
                   required>
        </div>

        <div class="col-md-4">
            <button type="submit"
                    class="btn btn-success mt-4">
                Enviar Solicitud
            </button>
        </div>

    </div>

</form>

<?php include_once "../view/partials/script.php"; ?>
