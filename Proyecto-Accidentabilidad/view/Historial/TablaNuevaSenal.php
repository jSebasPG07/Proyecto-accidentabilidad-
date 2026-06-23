<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado solicitudes de nueva señal
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($nuevasenal); ?>
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
                            <th>Tipo señal</th>
                            <th>Orientación</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($nuevasenal as $ns){ ?>

                            <tr>

                                <td><?php echo $ns['id_sol_nueva_sen']; ?></td>
                                <td><?php echo $ns['fecha_nueva_senal']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $ns['descripcion']; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($ns['imagen_url'] != ""){ ?>
                                        <img src="<?php echo $ns['imagen_url']; ?>"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    <?php } ?>
                                </td>

                                <td><?php echo $ns['direccion']; ?></td>

                                <td>
                                    <span class="badge badge-info px-2 py-1">
                                        <?php echo $ns['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $ns['tipo_senal']; ?></td>

                                <td><?php echo $ns['orientacion']; ?></td>

                                <td><?php echo $ns['usuario']; ?></td>

                                <td>
                                    <a href="<?php echo getUrl("Reportes","ReportesNS","getUpdate",array("id"=>$ns['id_sol_nueva_sen'])); ?>"
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