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
            <th>Tipo daño via</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        foreach($viamal as $vm){ 
                echo "<tr>";
                echo "<td>".$vm['id_sol_via_mal']."</td>";
                echo "<td>".$vm['fecha_via_mal_estado']."</td>";
                echo "<td>".$vm['descripcion']."</td>";  
                echo "<td>";
                if($vm['imagen_url'] != ""){
                    echo "<img src='".$vm['imagen_url']."' width='80'>";
                }
                echo "</td>";
                echo "<td>".$vm['direccion']."</td>";
                echo "<td>".$vm['estado']."</td>";
                echo "<td>".$vm['tipo_dano_via']."</td>";
                echo "<td>".$vm['usuario']."</td>";
                echo "<td><a href='".getUrl("Reportes","SolicitudVME","getUpdate",array("id" => $vm['id_sol_via_mal']))."'>
                    <button class='btn btn-primary'>Editar</button>
                </a></td>";
            echo "</tr>";
        } 
        ?>
    </tbody>
</table>