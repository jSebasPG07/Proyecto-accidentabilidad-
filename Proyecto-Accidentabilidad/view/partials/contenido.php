 <div class="d-flex justify-content-center">
        <div style="position:relative; display:inline-block;">
            <div class="mscross" style="overflow: hidden; width: 900px; height: 700px;
            -moz-user-select: none; position: relative;" id="dc_main">
            </div>

            <div id="Layer2">
     
             <form name="select_layers">
             <p align="left">
             <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[0]" value="cali">
            <strong>Area Cali</strong>

            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[1]" value="Comunas">
                <strong>Comunas</strong>

            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[2]" value="Barrios">
                <strong>Barrios</strong>

            <p align="left">
                <input CHECKED onClick="chgLayers()" type="checkbox" name="layer[3]" value="MallaVial">
                <strong>Malla Vial</strong>

     
            </form>
            </div>

            <div id="Layer1">
                <div style="overflow: auto; width: 140px; height: 140px; -moz-user-select: none; position: relative; z-index: 100;" id="dc_main2">
            </div>
        </div>
    </div>
     
        <script type="text/javascript">
                myMap1= new msMap ( document.getElementById("dc_main"), 'standardRight' );
                myMap1.setCgi( '/cgi-bin/mapserv.exe' );
                myMap1.setMapFile( 'C:/ms4w/Apache/htdocs/Giav-proyecto/Proyecto-accidentabilidad-/Proyecto-Accidentabilidad/web/mapaCali.map' );
                myMap1.setFullExtent( 1043800, 1075000, 860200 );
                myMap1.setLayers( 'cali Comunas Barrios MallaVial' );

                myMap2= new msMap ( document.getElementById("dc_main2") );
                myMap2.setActionNone();
                myMap2.setFullExtent( 1043800, 1075000, 860200 );
                myMap2.setMapFile( 'C:/ms4w/Apache/htdocs/Giav-proyecto/Proyecto-accidentabilidad-/Proyecto-Accidentabilidad/web/mapaCali.map' );
                myMap2.setLayers( 'cali' );
                myMap1.setReferenceMap(myMap2);

                myMap1.redraw();
                myMap2.redraw();
                chgLayers();

                function chgLayers() {
                var list = "Layers ";
                var inputs = document.forms["select_layers"].querySelectorAll('input[type="checkbox"]');

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].checked) {
                     list = list + inputs[i].value + " ";
                    }
                }

                myMap1.setLayers(list);
                myMap1.redraw();
                }



        </script>