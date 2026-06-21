<div class="mt-5">
    <h3 class="display-4">Listado solicitudes de señal mal estado</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>direccion</th>
            <th>estado</th>
            <th>Tipo señal</th>
            <th>Tipo daño señal</th>
            <th>Orientacion</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        
        foreach($senalmalestado as $sme){ 
            echo "<tr>";
                echo "<td>".$sme['id_sol_mal']."</td>";
                echo "<td>".$sme['fecha_senal_mal_estado']."</td>";
                echo "<td>".$sme['descripcion']."</td>";
                echo "<td>";
                if($sme['imagen_url'] != ""){
                    echo "<img src='".$sme['imagen_url']."' width='80'>";
                }
                echo "</td>";
                echo "<td>".$sme['direccion']."</td>";
                echo "<td>".$sme['estado']."</td>";
                echo "<td>".$sme['tipo_senal']."</td>";
                echo "<td>".$sme['tipo_dano_senal']."</td>";
                echo "<td>".$sme['orientacion']."</td>";
                echo "<td>".$sme['usuario']."</td>";
                echo "<td><a href='".getUrl("Reportes","ReportesSME","getUpdate",array("id" => $sme['id_sol_mal']))."'>
                    <button class='btn btn-primary'>Editar</button>
                </a></td>";
            echo "</tr>";
         } 
         ?>
    </tbody>
</table>