<?php
    // Agrupar los permisos por m&oacute;dulo para pintarlos organizados
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

<?php
if(isset($_GET['msg']) && $_GET['msg'] == "permisos"){
?>
    <div class="alert alert-danger">
        Debe seleccionar al menos un permiso para editar el rol.
    </div>
<?php
}
?>


<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">

        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">

            <i class="fas fa-user-lock"
               style="font-size:1.4rem;color:#fff;"></i>

        </div>

        <div>

            <h4 class="mb-0 fw-bold">Editar Permisos del Rol</h4>

            <small class="text-muted">
                Rol: <strong><?php echo $rol['nombre_rol']; ?></strong>
            </small>

        </div>

    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-body p-4">

            <form action="<?php echo getUrl("Usuario","GestionRoles","postUpdate"); ?>"
                  method="post">

                <input type="hidden"
                       name="id_rol"
                       value="<?php echo $rol['id_rol']; ?>">

                <?php foreach ($modulosAgrupados as $idModulo => $datosModulo): ?>

                    <div class="card border mb-3">

                        <div class="card-header bg-light">

                            <strong>
                                <?php echo $datosModulo['nombre_modulo']; ?>
                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <?php foreach ($datosModulo['permisos'] as $permiso): ?>

                                    <div class="col-md-4 mb-2">

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                name="permisos[]"
                                                id="permiso_<?php echo $permiso['id_permiso']; ?>"
                                                value="<?php echo $permiso['id_permiso']; ?>"

                                                <?php
                                                if (in_array($permiso['id_permiso'], $permisosAsignados)) {
                                                    echo "checked";
                                                }
                                                ?>>

                                            <label class="form-check-label"
                                                   for="permiso_<?php echo $permiso['id_permiso']; ?>">

                                                <strong>
                                                    <?php echo $permiso['nombre_accion']; ?>
                                                </strong>

                                                <br>

                                                <small class="text-muted">
                                                    <?php echo $permiso['nombre_permiso']; ?>
                                                </small>

                                            </label>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

                <div class="mt-4 d-flex gap-2">

                    <button type="submit"
                            class="btn btn-primary px-4">

                        <i class="fas fa-save me-2"></i>
                        Guardar Permisos

                    </button>

                    <a class="btn btn-outline-secondary px-4"
                       href="<?php echo getUrl("Usuario","GestionRoles","getList"); ?>">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>