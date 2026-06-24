<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado solicitudes de reductor en mal estado
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($reductormal); ?>
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
                            <th>identificacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($reductormal as $rm){ ?>

                            <tr>

                                <td><?php echo $rm['id_sol_red_mal']; ?></td>
                                <td><?php echo $rm['fecha_reductor_mal_estado']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $rm['descripcion']; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($rm['imagen_url'] != ""){ ?>
                                        <img src="<?php echo $rm['imagen_url']; ?>"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    <?php } ?>
                                </td>

                                <td><?php echo $rm['direccion']; ?></td>

                                <td>
                                    <span class="badge badge-warning px-2 py-1">
                                        <?php echo $rm['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $rm['tipo_reductor']; ?></td>

                                <td><?php echo $rm['tipo_dano_reductor']; ?></td>

                                <td><?php echo $rm['usuario']; ?></td>

                                <td><?php echo $rm['identificacion']; ?></td>

                                <td>
                                    <a href="<?php echo getUrl("Reportes","ReportesRME","getUpdate",array("id"=>$rm['id_sol_red_mal'])); ?>"
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