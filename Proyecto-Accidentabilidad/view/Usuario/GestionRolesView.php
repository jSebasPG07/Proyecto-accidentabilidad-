<div class="mt-3">
    <h3 class="display-3">Gesti&oacute;n de Roles</h3>
</div>

<a class="btn btn-primary mb-3"
   href="<?php echo getUrl("Usuario", "GestionRoles", "getCreate"); ?>">

    Crear Rol

</a>

<table class="table table-bordered table-hover mt-4">

    <thead>

        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

    <?php while($rol = pg_fetch_assoc($roles)){ ?>

        <tr>

            <td><?php echo $rol['id_rol']; ?></td>
            <td><?php echo $rol['nombre_rol']; ?></td>

            <td>

                <a class="btn btn-warning btn-sm"
                   href="<?php echo getUrl( "Usuario", "GestionRoles", "getEdit", array("id"=>$rol['id_rol']) ); ?>">

                    Editar permisos

                </a>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>

<?php include_once "../view/partials/script.php"; ?>
