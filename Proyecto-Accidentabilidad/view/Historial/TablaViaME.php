<div class="mt-5">
    <h3 class="display-4">Listado solicitudes reductor en mal estado</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>direccion</th>
            <th>estado</th>
            <th>Tipo daño via</th>
            <th>Usuario</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($viamal as $vm){ ?>
            <tr>
                <td><?= $vm['id_sol_via_mal'] ?></td>
                <td><?= $vm['descripcion'] ?></td>  
                <td><?php if($vm['imagen_url'] != ""){ ?>
                        <img src="<?= $vm['imagen_url'] ?>" width="80">
                    <?php } ?></td>
                <td><?= $vm['direccion'] ?></td>
                <td><?= $vm['estado'] ?></td>
                <td><?= $vm['tipo_dano_via'] ?></td>
                <td><?= $vm['usuario'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>