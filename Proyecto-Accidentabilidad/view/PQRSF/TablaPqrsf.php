<div class="mt-5">
    <h3 class="display-4">Listado de pqrsf</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Mensaje</th>
            <th>Respuesta</th>
            <th>Fecha Respuesta</th>
            <th>estado</th>
            <th>Tipo pqrsf</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            while($p = pg_fetch_assoc($pqrsf)){

            echo "<tr>";
                echo "<td>".$p['id_pqrsf']."</td>";
                echo "<td>".$p['fecha_pqrsf']."</td>";
                echo "<td>".$p['mensaje']."</td>";
                echo "<td>".$p['respuesta']."</td>";
                echo "<td>".$p['fecha_respuesta']."</td>";
                echo "<td>".$p['estado']."</td>";
                echo "<td>".$p['tipo_pqrsf']."</td>";
                echo "<td>".$p['usuarios']."</td>";

                echo "<td><a href='".getUrl("PQRSF","PqrsfC","getUpdate",array("id" => $p['id_pqrsf']))."'>
                    <button class='btn btn-primary'>Editar</button>
                </a></td>";

            echo "</tr>";
            }
            ?>    
    </tbody>
</table>