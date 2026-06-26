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
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Mensaje</th>
                            <th>Respuesta</th>
                            <th>Fecha Respuesta</th>
                            <th>Estado</th>
                            <th>Tipo PQRSF</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($p = pg_fetch_assoc($pqrsf)){ ?>

                            <tr>

                                <td><?php echo $p['id_pqrsf']; ?></td>

                                <td>
                                    <?php echo $p['fecha_pqrsf']; ?>
                                </td>

                                <td style="max-width:250px;">
                                    <span class="d-inline-block text-truncate" style="max-width:220px;">
                                        <?php echo $p['mensaje']; ?>
                                    </span>
                                </td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $p['respuesta'] != "" ? $p['respuesta'] : "<span class='text-muted'>Sin respuesta</span>"; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo ($p['fecha_respuesta'] != "") ? $p['fecha_respuesta'] : "<span class='text-muted'>Sin fecha</span>";?>
                                </td>

                                <td>
                                    <?php
                                     $estado = trim($p['estado']);

                                     if($estado == 'Pendiente'){
                                        $clase = 'badge badge-warning'; //amarillo
                                     }
                                     elseif($estado == 'En revision'){
                                         $clase = 'badge badge-primary'; //azul 
                                     }
                                     elseif($estado == 'En proceso'){
                                        $clase = 'badge badge-info'; //Azul claro
                                     }
                                     elseif($estado == 'Rechazada'){
                                        $clase = 'badge badge-danger'; // Rojo
                                     }
                                     elseif($estado == 'Completada'){
                                        $clase = 'badge badge-success'; //verde
                                     }
                                     
                                    ?>           
                                    <span class="<?php echo $clase; ?>">
                                        <?php echo $p['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $p['tipo_pqrsf']; ?></td>

                                <td><?php echo $p['usuarios']; ?></td>

                                <td>
                                    <?php if (Permisos::hasPermission(3, 3)): ?>
                                        <a href="<?php echo getUrl("PQRSF","PqrsfC","getUpdate",array("id"=>$p['id_pqrsf'])); ?>"
                                           class="btn btn-sm btn-primary">
                                            Editar
                                        </a>
                                    <?php endif; ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>