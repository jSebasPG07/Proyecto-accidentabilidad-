<div class="container-fluid mt-4">

    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-clipboard-list" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Listado de PQRSF</h4>
            <small class="text-muted">
                Consulta y gestiona las peticiones, quejas, reclamos, sugerencias y felicitaciones.
            </small>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado de PQRSF
            </h4>

            <span class="text-muted small">
                Total: <?php echo pg_num_rows($pqrsf); ?>
            </span>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Mensaje</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $datosModal = array();

                    while($p = pg_fetch_assoc($pqrsf)){

                        $datosModal[] = $p;

                        $estado = trim($p['estado']);

                        if($estado == 'Pendiente'){
                            $clase='badge badge-warning';
                        }elseif($estado == 'En revision'){
                            $clase='badge badge-primary';
                        }elseif($estado == 'En proceso'){
                            $clase='badge badge-info';
                        }elseif($estado == 'Rechazada'){
                            $clase='badge badge-danger';
                        }elseif($estado == 'Completada'){
                            $clase='badge badge-success';
                        }
                    ?>

                        <tr>

                            <td><?php echo $p['fecha_pqrsf']; ?></td>

                            <td style="max-width:250px;">
                                <span class="d-inline-block text-truncate" style="max-width:220px;">
                                    <?php echo $p['mensaje']; ?>
                                </span>
                            </td>

                            <td>
                                <span class="<?php echo $clase; ?>">
                                    <?php echo $estado; ?>
                                </span>
                            </td>

                            <td><?php echo $p['usuarios']; ?></td>

                            <td>

                                <button
                                    type="button"
                                    class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal<?php echo $p['id_pqrsf']; ?>">
                                    Ver PQRSF
                                </button>

                                <?php if (Permisos::hasPermission(3,3)){ ?>

                                    <a href="<?php echo getUrl("PQRSF","PqrsfC","getUpdate",array("id"=>$p['id_pqrsf'])); ?>"
                                       class="btn btn-primary btn-sm">
                                        Editar
                                    </a>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- MODALES -->

<?php foreach($datosModal as $p){ ?>

<div class="modal fade"
     id="modal<?php echo $p['id_pqrsf']; ?>"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    Informaci&oacute;n PQRSF
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label><strong>Fecha</strong></label>

                        <p class="form-control">
                            <?php echo $p['fecha_pqrsf']; ?>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Estado</strong></label>

                        <p class="form-control">
                            <?php echo $p['estado']; ?>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Usuario</strong></label>

                        <p class="form-control">
                            <?php echo $p['usuarios']; ?>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Tipo PQRSF</strong></label>

                        <p class="form-control">
                            <?php echo $p['tipo_pqrsf']; ?>
                        </p>

                    </div>


                    <div class="col-12 mb-3">

                        <label><strong>Mensaje</strong></label>

                        <textarea class="form-control" rows="5" readonly><?php echo $p['mensaje']; ?></textarea>

                    </div>

                    <div class="col-12 mb-3">

                        <label><strong>Respuesta</strong></label>

                        <textarea class="form-control" rows="5" readonly><?php echo $p['respuesta']; ?></textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Fecha respuesta</strong></label>

                        <p class="form-control">

                            <?php
                            if($p['fecha_respuesta']==""){
                                echo "Sin respuesta";
                            }else{
                                echo $p['fecha_respuesta'];
                            }
                            ?>

                        </p>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cerrar
                </button>

            </div>

        </div>

    </div>

</div>

<?php } ?>