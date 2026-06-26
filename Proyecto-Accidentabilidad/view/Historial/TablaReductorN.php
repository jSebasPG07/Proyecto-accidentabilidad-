<?php
    include_once "../lib/Permisos.php";
?>
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
                            <th>Dirección</th>
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Tipo reductor</th>
                            <th>Tipo daño</th>
                            <th>Usuario</th>
                            <th>identificacion</th>
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

                                <td><?php echo $rn['direccion']; ?></td>

                                <td><?php echo $rn['referencia']; ?></td>

                                <td>
                                    <?php
                                     $estado = trim($rn['estado']);

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
                                        <?php echo $rn['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $rn['tipo_reductor']; ?></td>

                                <td><?php echo $rn['tipo_dano_reductor']; ?></td>

                                <td><?php echo $rn['usuario']; ?></td>

                                <td><?php echo $rn['identificacion']; ?></td>

                                <td>
                                    <?php if (Permisos::hasPermission(3, 3)): ?>
                                        <a href="<?php echo getUrl("Reportes","ReportesSolicitudNR","getUpdate",array("id"=>$rn['id_sol_nuevas_red'])); ?>"
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