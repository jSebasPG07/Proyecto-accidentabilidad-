<!-- Coordenadas ocultas que se llenan al hacer clic en el mapa -->
<input type="hidden" id="coord_x" name="coord_x" value="">
<input type="hidden" id="coord_y" name="coord_y" value="">

<div class="col-12 mt-3">
    <label class="form-label fw-semibold">
        <i class="fas fa-map-marker-alt text-danger me-1"></i>
        Ubicaci&oacute;n en el mapa <span class="text-danger">*</span>
    </label>
    <p class="text-muted small mb-2">
        Haz clic en el mapa para marcar el lugar exacto del incidente.
    </p>

    <!-- Indicador de coordenada seleccionada -->
    <div id="coord_info" class="alert alert-warning py-2 small mb-2" style="display:none;">
        <i class="fas fa-check-circle text-success me-1"></i>
        Punto seleccionado: <strong id="coord_texto"></strong>
    </div>
    <div id="coord_pending" class="alert alert-secondary py-2 small mb-2">
        <i class="fas fa-mouse-pointer me-1"></i> A&uacute;n no has seleccionado un punto en el mapa.
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header text-white fw-semibold d-flex align-items-center justify-content-between"
             style="background-color:#2773F5; height:42px;">
            <span><i class="fas fa-map me-2"></i>Mapa de Cali &mdash; clic para seleccionar punto</span>
            <span class="badge bg-light text-dark" id="badge_herramienta">Activar herramienta </span>
        </div>
        <div class="card-body p-0 d-flex">

            <!-- Mapa -->
            <div class="mscross border"
                 style="overflow:hidden; width:650px; height:480px; -moz-user-select:none; position:relative;"
                 id="mapa_reporte">
            </div>

            <!-- Panel lateral del mapa -->
            <div class="p-2 border-start" style="min-width:160px;">
                <p class="fw-semibold small mb-2">Referencia</p>
                <div style="overflow:auto; width:140px; height:140px; -moz-user-select:none; position:relative;"
                     id="mapa_reporte_mini">
                </div>
                <hr>
                <p class="fw-semibold small mb-1">Capas</p>
                <div id="select_layers_reporte">
                    <div class="form-switch mb-1">
                        <input class="form-check-input" checked onclick="chgLayersReporte()" type="checkbox" id="rl0">
                        <label class="form-check-label small" for="rl0">Cali</label>
                    </div>
                    <div class="form-switch mb-1">
                        <input class="form-check-input" checked onclick="chgLayersReporte()" type="checkbox" id="rl1">
                        <label class="form-check-label small" for="rl1">Comunas</label>
                    </div>
                    <div class="form-switch mb-1">
                        <input class="form-check-input" checked onclick="chgLayersReporte()" type="checkbox" id="rl2">
                        <label class="form-check-label small" for="rl2">Malla Vial</label>
                    </div>
                    <div class="form-switch mb-1">
                        <input class="form-check-input" checked onclick="chgLayersReporte()" type="checkbox" id="rl3">
                        <label class="form-check-label small" for="rl3">Barrios</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="misc/lib/mscross-1.1.9.js"></script>
<script type="text/javascript">
(function() {
    var mapFile = 'C:/ms4w/Apache/htdocs/Giav-proyecto/Proyecto-Accidentabilidad/web/cali.map';

    var reMap = new msMap(document.getElementById("mapa_reporte"), 'standardRight');
    reMap.setCgi('/cgi-bin/mapserv.exe');
    reMap.setMapFile(mapFile);
    reMap.setFullExtent(1043800, 1075000, 860200);
    reMap.setLayers('Cali Comunas MallaVial Barrio');

    var reMap2 = new msMap(document.getElementById("mapa_reporte_mini"));
    reMap2.setActionNone();
    reMap2.setFullExtent(1053867, 1074000, 860200);
    reMap2.setMapFile(mapFile);
    reMap2.setLayers('Cali');
    reMap.setReferenceMap(reMap2);

    reMap.redraw();
    reMap2.redraw();

    // Herramienta de selección de punto
    var herramienta = new msTool('Seleccionar punto', activarSeleccion, 'misc/img/viajar.png', onClickMapa);
    reMap.getToolbar(0).addMapTool(herramienta);

    var modoSeleccion = false;

    function activarSeleccion(e, map) {
        map.getTagMap().style.cursor = "crosshair";
        modoSeleccion = true;
        document.getElementById('badge_herramienta').textContent = 'Haz clic en el mapa';
    }

    function onClickMapa(event, map, x, y, xx, yy) {
        if (!modoSeleccion) return;

        // Guardar coordenadas reales en los campos hidden
        document.getElementById('coord_x').value = xx;
        document.getElementById('coord_y').value = yy;

        // Actualizar indicadores visuales
        document.getElementById('coord_texto').textContent = 'X: ' + parseFloat(xx).toFixed(2) + '  Y: ' + parseFloat(yy).toFixed(2);
        document.getElementById('coord_info').style.display = 'block';
        document.getElementById('coord_pending').style.display = 'none';
        document.getElementById('badge_herramienta').textContent = 'Punto marcado';

        modoSeleccion = false;
        map.getTagMap().style.cursor = "default";
    }

    window.chgLayersReporte = function() {
        var capas = ['Cali', 'Comunas', 'Barrio', 'MallaVial'];
        var list = "";
        for (var i = 0; i < capas.length; i++) {
            var chk = document.getElementById('rl' + i);
            if (chk && chk.checked) {
                list += capas[i] + " ";
            }
        }
        reMap.setLayers(list);
        reMap.redraw();
    };
})();
</script>