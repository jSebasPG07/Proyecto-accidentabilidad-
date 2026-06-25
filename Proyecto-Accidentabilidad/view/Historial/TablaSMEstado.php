<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado solicitudes de señal en mal estado
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($senalmalestado); ?>
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
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Tipo señal</th>
                            <th>Tipo daño</th>
                            <th>Orientación</th>
                            <th>Usuario</th>
                            <th>identificacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($senalmalestado as $sme){ ?>

                            <tr>

                                <td><?php echo $sme['id_sol_mal']; ?></td>
                                <td><?php echo $sme['fecha_senal_mal_estado']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $sme['descripcion']; ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($sme['imagen_url'] != ""){ ?>
                                        <img src="<?php echo $sme['imagen_url']; ?>"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                    <?php } ?>
                                </td>

                                <td><?php echo $sme['direccion']; ?></td>

                                <td><?php echo $sme['referencia']; ?></td>

                                <td>
                                    <?php
                                     $estado = trim($sme['estado']);

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
                                        <?php echo $sme['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $sme['tipo_senal']; ?></td>

                                <td><?php echo $sme['tipo_dano_senal']; ?></td>

                                <td><?php echo $sme['orientacion']; ?></td>

                                <td><?php echo $sme['usuario']; ?></td>

                                <td><?php echo $sme['identificacion']; ?></td>

                                <td>
                                    <a href="<?php echo getUrl("Reportes","ReportesSME","getUpdate",array("id"=>$sme['id_sol_mal'])); ?>"
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