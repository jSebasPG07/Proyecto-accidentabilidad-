<div class="mt-3">
    <h3 class="display-3">Gestión de Usuarios</h3>
</div>

<table class="table table-bordered table-hover mt-4">

    <thead>

        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

    <?php while($user = pg_fetch_assoc($usuarios)){ ?>

        <tr>

            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['numero_id']; ?></td>
            <td><?php echo $user['nombre']." ".$user['apellido']; ?></td>
            <td><?php echo $user['correo']; ?></td>
            <td><?php echo $user['nombre_rol']; ?></td>
            <td><?php echo $user['estado']; ?></td>

            <td>

                <a class="btn btn-info btn-sm"
                   href="<?php echo getUrl(
                        "Usuario",
                        "GestionUsuario",
                        "getView",
                        array("id"=>$user['id'])
                   ); ?>">

                    Visualizar

                </a>

                <a class="btn btn-warning btn-sm"
                   href="<?php echo getUrl(
                        "Usuario",
                        "GestionUsuario",
                        "getEdit",
                        array("id"=>$user['id'])
                   ); ?>">

                    Editar

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<?php include_once "../view/partials/script.php"; ?>