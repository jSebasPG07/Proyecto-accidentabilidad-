<div class="mb-3">
    <label>Filtrar por tipo de reporte</label>

    <select id="filtro" class="form-control"
        data-url="<?php echo getUrl("Historial","MiHistorial","getFiltrar", false,"ajax"); ?>">

        <option value="accidente">Reporte Accidente</option>
        <option value="senal_nueva">Solicitud nueva señal</option>
        <option value="senal_mal">Solicitud señal en mal estado</option>
        <option value="reductor_nuevo">Solicitud nuevo reductor</option>
        <option value="reductor_mal">Solicitud reductor en mal estado</option>
        <option value="via_mal">Solicitud vía en mal estado</option>
    </select>
</div>

<div id="resultado"></div>
