<div class="container-fluid mt-3">

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body">

            <h5 class="mb-3 text-primary font-weight-bold">
                Filtrar por tipo de reporte
            </h5>

            <select id="filtro"
                    class="form-control form-control-lg"
                    data-url="<?php echo getUrl("Historial","MiHistorial","getFiltrar", false,"ajax"); ?>">

            <option value="accidente">Reporte Accidente</option>
            <option value="senal_nueva">Solicitud nueva se&ntilde;al</option>
            <option value="senal_mal">Solicitud se&ntilde;al en mal estado</option>
            <option value="reductor_nuevo">Solicitud nuevo reductor</option>
            <option value="reductor_mal">Solicitud reductor en mal estado</option>
            <option value="via_mal">Solicitud v&iacute;a en mal estado</option>
            </select>

        </div>
    </div>

</div>

<div id="resultado" class="mt-4 container-fluid"></div>