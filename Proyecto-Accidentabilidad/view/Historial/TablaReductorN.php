<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado solicitudes de nuevo reductor
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($reductornuevo); ?>
            </span>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Tipo reductor</th>
                            <th>Tipo daño</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($reductornuevo as $rn){ ?>

                            <tr>

                                <td><?php echo $rn['id_sol_nuevas_red']; ?></td>
                                <td><?php echo $rn['fecha_nuevo_reductor']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $rn['descripcion']; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($rn['imagen_url'] != ""){ ?>
                                        <img src="<?php echo $rn['imagen_url']; ?>"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    <?php } ?>
                                </td>

                                <td><?php echo $rn['direccion']; ?></td>

                                <td>
                                    <span class="badge badge-info px-2 py-1">
                                        <?php echo $rn['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $rn['tipo_reductor']; ?></td>

                                <td><?php echo $rn['tipo_dano_reductor']; ?></td>

                                <td><?php echo $rn['usuario']; ?></td>

                                <td>
                                    <a href="<?php echo getUrl("Reportes","ReportesSolicitudNR","getUpdate",array("id"=>$rn['id_sol_nuevas_red'])); ?>"
                                       class="btn btn-sm btn-primary">
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