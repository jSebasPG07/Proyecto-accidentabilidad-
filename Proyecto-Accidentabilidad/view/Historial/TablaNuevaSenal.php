<div class="mt-5">
    <h3 class="display-4">Listado de solicitudes de nueva señal</h3>
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
            <th>Orientacion</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
foreach($nuevasenal as $ns){

    echo "<tr>";

    echo "<td>".$ns['id_sol_nueva_sen']."</td>";
    echo "<td>".$ns['fecha_nueva_senal']."</td>";
    echo "<td>".$ns['descripcion']."</td>";

    echo "<td>";
    if($ns['imagen_url'] != ""){
        echo "<img src='".$ns['imagen_url']."' width='80'>";
    }
    echo "</td>";

    echo "<td>".$ns['direccion']."</td>";
    echo "<td>".$ns['estado']."</td>";
    echo "<td>".$ns['tipo_senal']."</td>";
    echo "<td>".$ns['orientacion']."</td>";
    echo "<td>".$ns['usuario']."</td>";

    echo "<td><a href='".getUrl("Reportes","ReportesA","getUpdate",array("id" => $ns['id_sol_nueva_sen']))."'>
            <button class='btn btn-primary'>Editar</button>
          </a></td>";

    echo "</tr>";
}
?>    
    </tbody>
</table>