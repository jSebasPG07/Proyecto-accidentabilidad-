<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-history" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Mi Historial de Reportes</h4>
            <small class="text-muted">
                Consulta y gestiona los reportes realizados.
            </small>
        </div>
    </div>

    <!-- Filtro -->
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