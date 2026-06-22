<?php
    // Agrupar los permisos por modulo para pintarlos organizados
    $modulosAgrupados = array();

    while ($fila = pg_fetch_assoc($modulosPermisos)) {
        $idModulo = $fila['id_modulo'];

        if (!isset($modulosAgrupados[$idModulo])) {
            $modulosAgrupados[$idModulo] = array(
                'nombre_modulo' => $fila['nombre_modulo'],
                'permisos' => array()
            );
        }

        $modulosAgrupados[$idModulo]['permisos'][] = array(
            'id_permiso' => $fila['id_permiso'],
            'nombre_permiso' => $fila['nombre_permiso'],
            'nombre_accion' => $fila['nombre_accion'],
        );
    }
?>

<div class="container mt-4">

    <h3>Crear Rol</h3>

    <hr>

    <form action="<?php echo getUrl("Usuario", "GestionRoles", "postCreate"); ?>"
          method="post">

        <div class="form-group mb-3">

            <label>Nombre del Rol</label>

            <input type="text"
                   class="form-control"
                   name="nombre_rol"
                   placeholder="Ej: Supervisor"
                   required>

        </div>

        <?php foreach ($modulosAgrupados as $idModulo => $datosModulo): ?>

            <div class="card mb-3">

                <div class="card-header">
                    <strong><?php echo $datosModulo['nombre_modulo']; ?></strong>
                </div>

                <div class="card-body">

                    <?php foreach ($datosModulo['permisos'] as $permiso): ?>

                        <div class="form-check form-check-inline">

                            <input type="checkbox"
                                   class="form-check-input"
                                   name="permisos[]"
                                   id="permiso_<?php echo $permiso['id_permiso']; ?>"
                                   value="<?php echo $permiso['id_permiso']; ?>">

                            <label class="form-check-label" for="permiso_<?php echo $permiso['id_permiso']; ?>">
                                <?php echo $permiso['nombre_accion']; ?> &mdash; <?php echo $permiso['nombre_permiso']; ?>
                            </label>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endforeach; ?>

        <button type="submit" class="btn btn-success mt-3">
            Crear Rol
        </button>

        <a class="btn btn-secondary mt-3"
           href="<?php echo getUrl("Usuario", "GestionRoles", "getList"); ?>">
            Cancelar
        </a>

    </form>

</div>

<?php include_once "../view/partials/script.php"; ?>
