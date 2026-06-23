<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-primary font-weight-bold">
                Listado de Accidentes
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($accidentes); ?>
            </span>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Nomenclatura</th>
                            <th>Lesionados</th>
                            <th>Observaciones</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Tipo Choque</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($accidentes as $a){ ?>

                            <tr>

                                <td><?php echo $a['id_reporte_acc']; ?></td>
                                <td><?php echo $a['fecha_accidente']; ?></td>
                                <td><?php echo $a['nomenclatura']; ?></td>
                                <td><?php echo $a['num_lesionados']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $a['observaciones']; ?>
                                    </span>
                                </td>

                                <td><?php echo $a['direccion']; ?></td>

                                <td>
                                    <span class="badge badge-info px-2 py-1">
                                        <?php echo $a['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $a['tipo_choque']; ?></td>

                                <td>
                                    <?php if($a['imagen_url'] != ""){ ?>
                                        <img src="<?php echo $a['imagen_url']; ?>"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    <?php } ?>
                                </td>

                                <td>
                                    <a href="<?php echo getUrl("Reportes","ReportesA","getUpdate",array("id"=>$a['id_reporte_acc'])); ?>"
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