<div class="mt-5">
    <h3 class="display-4">Listado solicitudes reductor en mal estado</h3>
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
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            foreach($reductormal as $rm){ 
            echo "<tr>";
                echo "<td>".$rm['id_sol_red_mal']."</td>";
                echo "<td>".$rm['fecha_reductor_mal_estado']."</td>";
                echo "<td>".$rm['descripcion']."</td>";
                echo "<td>";
                    if($rm['imagen_url'] != ""){ 
                        echo "<img src='".$rm['imagen_url']."' width='80'>";
                     }
                    echo "</td>";
                echo "<td>".$rm['direccion']."</td>";
                echo "<td>".$rm['estado']."</td>";
                echo "<td>".$rm['tipo_reductor']."</td>";
                echo "<td>".$rm['tipo_dano_reductor']."</td>";
                echo "<td>".$rm['usuario']."</td>";
                echo "<td><a href='".getUrl("Reportes","ReportesRME","getUpdate",array("id" => $rm['id_sol_red_mal']))."'>
                        <button class='btn btn-primary'>Editar</button>
                     </a></td>";
            echo "</tr>";
        } 
        ?>
    </tbody>
</table>