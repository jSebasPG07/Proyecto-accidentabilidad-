<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-users-cog" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Gesti&oacute;n de Usuarios</h4>
            <small class="text-muted">Consulta y administra la informaci&oacute;n de los usuarios registrados.</small>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">Listado de Usuarios</h4>

            <span class="text-muted small">Total: <?php echo pg_num_rows($usuarios); ?></span>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="thead-dark">

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

                            <td>
                                <?php
                                    $estado = trim($user['estado']);

                                    if($estado == 'Habilitado'){
                                        $clase = 'badge badge-success';
                                    }
                                    elseif($estado == 'Inhabilitado'){
                                        $clase = 'badge badge-danger';
                                    }
                                ?>
                                    <span class="<?php echo $clase; ?>">
                                        <?php echo $user['estado']; ?>
                                    </span>                
                            </td>

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

            </div>

        </div>

    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>