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
                     style="background-color:#1A7C43; height:46px;">
                    <i class="fas fa-map me-2"></i> Mapa de Cali
                </div>
                <div class="card-body p-0">
                    <div class="mscross border"
                         style="overflow:hidden; width:1147px; height:700px; -moz-user-select:none; position:relative;"
                         id="dc_main">
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="col-12 col-md-3 d-flex flex-column gap-3">

            <!-- Minimapa -->
            <div class="card shadow-sm border-0">
                <div class="card-header text-white fw-semibold"
                     style="background-color:#138241;">
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
                     style="background-color:#177B40;">
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

            <!-- Leyenda -->
            <div class="card shadow-sm border-0">
                <div class="card-header text-white fw-semibold"
                     style="background-color:#177B40;">
                    <i class="fas fa-info-circle me-1"></i> Leyenda
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span style="color:#c80000;font-size:1.2rem;">&#9733;</span>
                        <span class="small">Accidente reportado</span>
                    </div>
                </div>
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
    myMap2.setFullExtent(1053867, 1074000, 860200);
    myMap2.setMapFile(mapFile);
    myMap2.setLayers('Cali');
    myMap1.setReferenceMap(myMap2);

    myMap1.redraw();
    myMap2.redraw();
    chgLayers();

    function chgLayers() {
        var list = "";
        var objForm = document.forms["select_layers"];
        for (var i = 0; i < objForm.length; i++) {
            if (objForm.elements["layer[" + i + "]"].checked) {
                list += objForm.elements["layer[" + i + "]"].value + " ";
            }
        }
        myMap1.setLayers(list);
        myMap1.redraw();
    }
</script>