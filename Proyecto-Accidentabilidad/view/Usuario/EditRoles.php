<?php
    // Agrupar los permisos por módulo para pintarlos organizados
    // $modulosPermisos viene como resource de pg_query, lo recorremos UNA vez aquí
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

    <h3>Editar Permisos del Rol: <?php echo $rol['nombre_rol']; ?></h3>

    <hr>

    <form action="<?php echo getUrl("Usuario", "GestionRoles", "postUpdate"); ?>"
          method="post">

        <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol']; ?>">

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
                                   value="<?php echo $permiso['id_permiso']; ?>"
                                   <?php if (in_array($permiso['id_permiso'], $permisosAsignados)) { echo "checked"; } ?>>

                            <label class="form-check-label" for="permiso_<?php echo $permiso['id_permiso']; ?>">
                                <?php echo $permiso['nombre_accion']; ?> &mdash; <?php echo $permiso['nombre_permiso']; ?>
                            </label>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endforeach; ?>

        <button type="submit" class="btn btn-success mt-3">
            Guardar Permisos
        </button>

        <a class="btn btn-secondary mt-3"
           href="<?php echo getUrl("Usuario", "GestionRoles", "getList"); ?>">
            Cancelar
        </a>

    </form>

</div>

<?php include_once "../view/partials/script.php"; ?>
