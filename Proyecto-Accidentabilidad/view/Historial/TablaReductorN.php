<div class="mt-5">
    <h3 class="display-4">Listado solicitudes reductor de velocidad nuevo </h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>direccion</th>
            <th>estado</th>
            <th>Tipo reductor</th>
            <th>Tipo daño reductor</th>
            <th>Usuario</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($reductornuevo as $rn){ ?>
            <tr>
                <td><?= $rn['id_sol_nuevas_red'] ?></td>
                <td><?= $rn['descripcion'] ?></td>
                <td><?php if($rn['imagen_url'] != ""){ ?>
                        <img src="<?= $rn['imagen_url'] ?>" width="80">
                    <?php } ?></td>
                <td><?= $rn['direccion'] ?></td>
                <td><?= $rn['estado'] ?></td>
                <td><?= $rn['tipo_reductor'] ?></td>
                <td><?= $rn['tipo_dano_reductor'] ?></td>
                <td><?= $rn['usuario'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>