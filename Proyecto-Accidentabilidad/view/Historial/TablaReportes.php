<div class="mt-5">
    <h3 class="display-4">Listado de Accidentes</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Nomenclatura</th>
            <th>Lesionados</th>
            <th>Observaciones</th>
            <th>Dirección</th>
            <th>estado</th>
            <th>Tipo Choque</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            
            foreach($accidentes as $a){ 
            echo "<tr>";
                echo "<td>".$a['id_reporte_acc']."</td>";
                echo "<td>".$a['fecha_accidente']."</td>";
                echo "<td>".$a['nomenclatura']."</td>";
                echo "<td>".$a['num_lesionados']."</td>";
                echo "<td>".$a['observaciones']."</td>";
                echo "<td>".$a['direccion']."</td>";
                echo "<td>".$a['estado']."</td>";
                echo "<td>".$a['tipo_choque']."</td>";
                echo "<td>";
                    if($a['imagen_url'] != ""){ 
                        echo "<img src='".$a['imagen_url']."' width='80'>";
                     }
                echo "</td>";
                echo "<td><a href='".getUrl("Reportes","ReportesA","getUpdate",array("id" => $a['id_reporte_acc']))."'>
                        <button class='btn btn-primary'>Editar</button>
                     </a></td>";
            echo "</tr>";
            
        } 
        ?>
    </tbody>
</table>
