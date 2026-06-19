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
        </tr>
    </thead>

    <tbody>
        <?php foreach($senalmalestado as $sme){ ?>
            <tr>
                <td><?= $sme['id_sol_mal'] ?></td>
                <td><?= $sme['fecha_senal_mal_estado'] ?></td>
                <td><?= $sme['descripcion'] ?></td>
                <td><?php if($sme['imagen_url'] != ""){ ?>
                        <img src="<?= $sme['imagen_url'] ?>" width="80">
                    <?php } ?></td>
                <td><?= $sme['direccion'] ?></td>
                <td><?= $sme['estado'] ?></td>
                <td><?= $sme['tipo_senal'] ?></td>
                <td><?= $sme['tipo_dano_senal'] ?></td>
                <td><?= $sme['orientacion'] ?></td>
                <td><?= $sme['usuario'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>