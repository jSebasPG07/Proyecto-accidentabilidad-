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
                            <th>Fecha</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($accidentes as $a){ ?>

                            <tr>

                                
                                <td><?php echo $a['fecha_accidente']; ?></td>
                                
                                <td><?php echo $a['direccion']; ?></td>

                                <td>
                                    <?php
                                     $estado = trim($a['estado']);

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
                                        <?php echo $a['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $a['usuario']; ?></td>
                                
                                <td>
                                    <?php if (Permisos::hasPermission(3, 3)): ?>
                                        <a href="<?php echo getUrl("Reportes","ReportesA","getUpdate",array("id"=>$a['id_reporte_acc'])); ?>"
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