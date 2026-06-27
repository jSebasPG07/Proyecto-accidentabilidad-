<?php
    include_once "../lib/Permisos.php";
?>

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
                            
                            <th>Fecha</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($nuevasenal as $ns){ ?>

                            <tr>

                                <td><?php echo $ns['fecha_nueva_senal']; ?></td>

                                <td><?php echo $ns['direccion']; ?></td>


                                <td>
                                    <?php
                                     $estado = trim($ns['estado']);

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
                                        <?php echo $ns['estado']; ?>
                                    </span>
                                </td>

                                <td><?php echo $ns['usuario']; ?></td>

                                <td>

                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal<?php echo $ns['id_sol_nueva_sen']; ?>">
                                        Ver solicutud
                                    </button>

                                    <?php if (Permisos::hasPermission(3, 3)): ?>
                                        <a href="<?php echo getUrl("Reportes","ReportesNS","getUpdate",array("id"=>$ns['id_sol_nueva_sen'])); ?>"
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

<?php foreach($nuevasenal as $ns){ ?>

<div class="modal fade"
     id="modal<?php echo $ns['id_sol_nueva_sen']; ?>"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    Información de solicitud de nueva señal
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
                            <?php echo $ns['fecha_nueva_senal']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Estado</strong></label>
                        <p class="form-control">
                            <?php echo $ns['estado']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Usuario</strong></label>
                        <p class="form-control">
                            <?php echo $ns['usuario']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Identificación</strong></label>
                        <p class="form-control">
                            <?php echo $ns['identificacion']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Dirección</strong></label>
                        <p class="form-control">
                            <?php echo $ns['direccion']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Lugar de referencia</strong></label>
                        <p class="form-control">
                            <?php echo $ns['referencia']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Tipo de señal</strong></label>
                        <p class="form-control">
                            <?php echo $ns['tipo_senal']; ?>
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Orientacion</strong></label>
                        <p class="form-control">
                            <?php echo $ns['orientacion']; ?>
                        </p>
                    </div>

                    <div class="col-12 mb-3">
                        <label><strong>Coordenadas</strong></label>
                        <p class="form-control">
                            <?php echo $ns['coordenadas']; ?>
                        </p>
                    </div>


                    <div class="col-12 mb-3">

                        <label><strong>Descripcion</strong></label>

                        <textarea
                            class="form-control"
                            rows="4"
                            readonly><?php echo $ns['descripcion']; ?></textarea>

                    </div>
                    

                    <div class="col-12 mb-3">

                        <label><strong>Imagen de nueva señal</strong></label>

                        <?php if(!empty($ns['imagen_url'])){ ?>

                            <img src="../img/<?php echo $ns['imagen_url']; ?>"
                                 class="img-fluid rounded border"
                                 style="max-height:350px;width:100%;object-fit:cover;">

                        <?php }else{ ?>

                            <p class="form-control">
                                Sin imagen
                            </p>

                        <?php } ?>

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