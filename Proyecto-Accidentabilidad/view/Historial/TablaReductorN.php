<div class="mt-5">
    <h3 class="display-4">Listado solicitudes reductor de velocidad nuevo </h3>
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
            <th>Tipo reductor</th>
            <th>Tipo daño reductor</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($reductornuevo as $rn){ 
            echo "<tr>";
                echo "<td>".$rn['id_sol_nuevas_red']."</td>";
                echo "<td>".$rn['fecha_nuevo_reductor']."</td>";
                echo "<td>".$rn['descripcion']."</td>";
                echo "<td>";
                if($rn['imagen_url'] != ""){
                    echo "<img src='".$rn['imagen_url']."' width='80'>";
                }
                echo "</td>";
                echo "<td>".$rn['direccion']."</td>";
                echo "<td>".$rn['estado']."</td>";
                echo "<td>".$rn['tipo_reductor']."</td>";
                echo "<td>".$rn['tipo_dano_reductor']."</td>";
                echo "<td>".$rn['usuario']."</td>";
                echo "<td><a href='".getUrl("Reportes","ReportesSolicitudNR","getUpdate",array("id" => $rn['id_sol_nuevas_red']))."'>
                    <button class='btn btn-primary'>Editar</button>
                </a></td>";
            echo "</tr>";
         } 
         ?>
    </tbody>
</table>