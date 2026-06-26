<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-user-shield" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Gesti&oacute;n de Roles</h4>
            <small class="text-muted">Administra los roles y permisos del sistema.</small>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">Listado de Roles</h4>

            <div class="d-flex align-items-center gap-3">

                <span class="text-muted small">Total: <?php echo pg_num_rows($roles); ?></span>

                <a class="btn btn-primary"
                   href="<?php echo getUrl("Usuario", "GestionRoles", "getCreate"); ?>">
                    <i class="fas fa-plus me-2"></i>
                    Crear Rol
                </a>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="thead-dark">

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

                                    <a class="btn btn-sm btn-primary"
                                       href="<?php echo getUrl(
                                            "Usuario",
                                            "GestionRoles",
                                            "getEdit",
                                            array("id"=>$rol['id_rol'])
                                       ); ?>">

                                        <i class="fas fa-user-lock me-1"></i>
                                        Editar Permisos

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>