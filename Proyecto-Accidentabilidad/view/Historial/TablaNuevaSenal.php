<div class="mt-5">
    <h3 class="display-4">Listado de solicitudes de nueva señal</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>direccion</th>
            <th>estado</th>
            <th>Tipo señal</th>
            <th>Orientacion</th>
            <th>Usuario</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($nuevasenal as $ns){ ?>
            <tr>
                <td><?= $ns['id_sol_nueva_sen'] ?></td>
                <td><?= $ns['descripcion'] ?></td>
                <td><?php if($ns['imagen_url'] != ""){ ?>
                        <img src="<?= $ns['imagen_url'] ?>" width="80">
                    <?php } ?></td>
                <td><?= $ns['direccion'] ?></td>
                <td><?= $ns['estado'] ?></td>
                <td><?= $ns['tipo_senal'] ?></td>
                <td><?= $ns['orientacion'] ?></td>
                <td><?= $ns['usuario'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>