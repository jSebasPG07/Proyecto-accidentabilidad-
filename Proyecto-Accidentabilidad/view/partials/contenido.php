<div class="container-fluid px-3 py-3">

    <div class="d-flex align-items-center mb-3 gap-3">
        <div class="bg-danger rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-map-marked-alt" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Mapa de Accidentes - Cali</h4>
            <p class="text-muted mb-0 small">Visualizaci&oacute;n geogr&aacute;fica de accidentes reportados</p>
        </div>
    </div>

    <div class="row g-3">

        <!-- Mapa principal -->
        <div class="col-12 col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white fw-semibold d-flex align-items-center"
                     style="background-color:#2773F5; height:46px;">
                    <i class="fas fa-map me-2"></i> Mapa de Cali
                </div>
                <div class="card-body p-0">
                    <div style="overflow-x:auto; width:100%;">
                        <div class="mscross border"
                             style="overflow:hidden; width:785px; height:660px; -moz-user-select:none; position:relative;"
                             id="dc_main">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="col-12 col-md-3 d-flex flex-column gap-3">

            <!-- Minimapa -->
            <div class="card shadow-sm border-0">
                <div class="card-header text-white fw-semibold"
                     style="background-color:#2773F5;">
                    <i class="fas fa-search-location me-1"></i> Referencia
                </div>
                <div class="card-body p-2 d-flex justify-content-center">
                    <div style="overflow:auto; width:140px; height:140px; -moz-user-select:none; position:relative;"
                         id="dc_main2">
                    </div>
                </div>
            </div>

            <!-- Capas -->
            <div class="card shadow-sm border-0">
                <div class="card-header text-white fw-semibold"
                     style="background-color:#2773F5;">
                    <i class="fas fa-layer-group me-1"></i> Capas
                </div>
                <div class="card-body">
                    <form name="select_layers">
                        <div class="form-switch mb-1">
                            <input class="form-check-input" checked onclick="chgLayers()" type="checkbox" name="layer[0]" value="Cali" id="chk0">
                            <label class="form-check-label" for="chk0">Cali</label>
                        </div>
                        <div class="form-switch mb-1">
                            <input class="form-check-input" checked onclick="chgLayers()" type="checkbox" name="layer[1]" value="Comunas" id="chk1">
                            <label class="form-check-label" for="chk1">Comunas</label>
                        </div>
                        <div class="form-switch mb-1">
                            <input class="form-check-input" checked onclick="chgLayers()" type="checkbox" name="layer[2]" value="Barrio" id="chk2">
                            <label class="form-check-label" for="chk2">Barrios</label>
                        </div>
                        <div class="form-switch mb-1">
                            <input class="form-check-input" checked onclick="chgLayers()" type="checkbox" name="layer[3]" value="MallaVial" id="chk3">
                            <label class="form-check-label" for="chk3">Malla Vial</label>
                        </div>
                        <div class="form-switch mb-1">
                            <input class="form-check-input" checked onclick="chgLayers()" type="checkbox" name="layer[4]" value="Accidentes" id="chk4">
                            <label class="form-check-label" for="chk4">
                                <span class="text-danger fw-semibold">Accidentes</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal detalle accidente -->
<div class="modal fade" id="modalAccidente" tabindex="-1" aria-labelledby="modalAccidenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#2773F5;">
                <h5 class="modal-title" id="modalAccidenteLabel">
                    <i class="fas fa-car-crash me-2"></i> Detalle del Accidente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalAccidenteBody">
                <div class="text-center py-4">
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="mt-2 text-muted">Buscando reporte...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="misc/lib/mscross-1.1.9.js"></script>
<script type="text/javascript">
    var mapFile = 'C:/ms4w/Apache/htdocs/Giav-proyecto/Proyecto-accidentabilidad-/Proyecto-Accidentabilidad/web/cali.map';

    myMap1 = new msMap(document.getElementById("dc_main"), 'standardRight');
    myMap1.setCgi('/cgi-bin/mapserv.exe');
    myMap1.setMapFile(mapFile);
    myMap1.setFullExtent(1043800, 1075000, 860200);
    myMap1.setLayers('Cali Comunas Barrio MallaVial Accidentes');

    myMap2 = new msMap(document.getElementById("dc_main2"));
    myMap2.setActionNone();
    myMap2.setFullExtent(1043800, 1075000, 860200);
    myMap2.setMapFile(mapFile);
    myMap2.setLayers('Cali');
    myMap1.setReferenceMap(myMap2);

    myMap1.redraw();
    myMap2.redraw();
    chgLayers();

    // Herramienta consultar accidente (basada en query2 de visorDinamicoCali.php)
    var toolConsulta = new msTool('Consultar accidente', activarConsulta, 'misc/img/consultar_accidente.png', queryAccidente);
    myMap1.getToolbar(0).addMapTool(toolConsulta);

    var consultaActiva = false;

    function activarConsulta(e, map) {
        map.getTagMap().style.cursor = "crosshair";
        consultaActiva = true;
    }

    function queryAccidente(event, map, x, y, xx, yy) {
        if (!consultaActiva) return;
        consultaActiva = false;
        map.getTagMap().style.cursor = "default";

        // Mostrar modal con spinner
        document.getElementById('modalAccidenteBody').innerHTML =
            '<div class="text-center py-4"><div class="spinner-border text-success" role="status"></div>' +
            '<p class="mt-2 text-muted">Buscando reporte...</p></div>';
        var modal = new bootstrap.Modal(document.getElementById('modalAccidente'));
        modal.show();

        // AJAX al endpoint (patrón de consulta_ejemplo.php)
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "consultar_accidente.php?x=" + encodeURIComponent(xx) + "&y=" + encodeURIComponent(yy), true); // Se envían las coordenadas del punto seleccionado al archivo PHP.
        xhr.onreadystatechange = function() { // Se ejecuta cuando el servidor responde.
            if (xhr.readyState == 4) {
                var data = JSON.parse(xhr.responseText);  // Convierte la respuesta JSON en un objeto JavaScript.
                if (data.encontrado) {
                    var img = data.imagen // Si el reporte tiene imagen, la prepara para mostrarla.
                        ? '<img src="../img/' + data.imagen + '" class="img-fluid rounded mb-3" style="max-height:220px;object-fit:cover;width:100%;">'
                        : '';

                        // Se llena el modal con toda la información del accidente.
                    document.getElementById('modalAccidenteBody').innerHTML = 
                        img +
                        '<div class="row g-2">' +
                        '<div class="col-6"><span class="text-muted small">ID Reporte</span><p class="fw-semibold mb-1">#' + data.id + '</p></div>' +
                        '<div class="col-6"><span class="text-muted small">Fecha</span><p class="fw-semibold mb-1">' + (data.fecha || '—') + '</p></div>' +

                        '<div class="col-6"><span class="text-muted small">Direcci&oacute;n</span><p class="fw-semibold mb-1">' + (data.direccion || '—') + '</p></div>' +
                        '<div class="col-6"><span class="text-muted small">Barrio</span><p class="fw-semibold mb-1">' + (data.barrio || '—') + '</p></div>' +

                        '<div class="col-6"><span class="text-muted small">Tipo de choque</span><p class="fw-semibold mb-1">' + (data.tipo_choque || '—') + '</p></div>' +
                        '<div class="col-6"><span class="text-muted small">Lesionados</span><p class="fw-semibold mb-1">' + (data.lesionados || '0') + '</p></div>' +

                        '<div class="col-6"><span class="text-muted small">Estado</span><p class="fw-semibold mb-1">' + (data.estado || '—') + '</p></div>' +
                        '<div class="col-6"><span class="text-muted small">Reportado por</span><p class="fw-semibold mb-1">' + (data.reportado_por || '—') + '</p></div>' +

                        '<div class="col-12"><span class="text-muted small">Observaciones</span><p class="fw-semibold mb-1">' + (data.observaciones || '—') + '</p></div>' +

                        '<div class="col-12 text-muted" style="font-size:0.75rem;">Distancia al punto seleccionado: ' + data.distancia + ' m</div>' +
                        '</div>';
                } else { // Si no hay accidentes cercanos, se informa al usuario.
                    document.getElementById('modalAccidenteBody').innerHTML =
                        '<div class="text-center py-4 text-muted">' +
                        '<i class="fas fa-map-marker-alt fa-2x mb-2"></i>' +
                        '<p>No se encontró ning&uacute;n accidente cercano al punto seleccionado.</p></div>';
                }
            }
        };
        xhr.send(null); // Se envía la petición al servidor.
    }

    function chgLayers() {
        var list = "";
        var objForm = document.forms["select_layers"]; // Se obtiene el formulario que contiene los checkbox.
        for (var i = 0; i < objForm.length; i++) { // Se recorren todas las opciones del formulario.
            if (objForm.elements["layer[" + i + "]"].checked) { // Si una capa está seleccionada, se agrega a la lista.
                list += objForm.elements["layer[" + i + "]"].value + " ";
            }
        }
        myMap1.setLayers(list);
        myMap1.redraw();
    }
</script>