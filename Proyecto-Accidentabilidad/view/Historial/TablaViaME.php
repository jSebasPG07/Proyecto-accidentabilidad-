<div class="container-fluid mt-4">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h4 class="mb-0 text-primary font-weight-bold">
                Listado solicitudes de vía en mal estado
            </h4>

            <span class="text-muted small">
                Total: <?php echo count($viamal); ?> 
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
                            <th>Dirección</th>
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Tipo daño vía</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($viamal as $vm){ ?>

                            <tr>

                                <td><?php echo $vm['id_sol_via_mal']; ?></td>
                                <td><?php echo $vm['fecha_via_mal_estado']; ?></td>

                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate" style="max-width:200px;">
                                        <?php echo $vm['descripcion']; ?>
                                    </span>
                                </td>


                                <td><?php echo $vm['direccion']; ?></td>

                                <td><?php echo $vm['referencia']; ?></td>

                                <td>
                                    <?php
                                     $estado = trim($vm['estado']);

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
                                        <?php echo $vm['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $vm['tipo_dano_via']; ?></td>

                                <td><?php echo $vm['usuario']; ?></td>

                                <td>
                                    <?php if (Permisos::hasPermission(3, 3)): ?>
                                        <a href="<?php echo getUrl("Reportes","SolicitudVME","getUpdate",array("id"=>$vm['id_sol_via_mal'])); ?>"
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