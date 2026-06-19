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
        </tr>
    </thead>

    <tbody>
        <?php foreach($reductormal as $rm){ ?>
            <tr>
                <td><?= $rm['id_sol_red_mal'] ?></td>
                <td><?= $rm['fecha_reductor_mal_estado'] ?></td>
                <td><?= $rm['descripcion'] ?></td>
                <td><?php if($rm['imagen_url'] != ""){ ?>
                        <img src="<?= $rm['imagen_url'] ?>" width="80">
                    <?php } ?></td>
                <td><?= $rm['direccion'] ?></td>
                <td><?= $rm['estado'] ?></td>
                <td><?= $rm['tipo_reductor'] ?></td>
                <td><?= $rm['tipo_dano_reductor'] ?></td>
                <td><?= $rm['usuario'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>