<div class="container-fluid mt-4">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
                 style="width:54px;height:54px;flex-shrink:0;">
                <i class="fas fa-chart-line text-white" style="font-size:1.4rem;"></i>
            </div>

            <div>
                <h4 class="mb-0 fw-bold">Zona Mayor Accidentabilidad</h4>
                <small class="text-muted">Consulta las estad&iacute;sticas y analiza las zonas con mayor incidencia de accidentes.</small>
            </div>

        </div>

        <a href="<?php echo getUrl("Estadisticas","ZonaMayAccidentabilidad","exportarExcel", false, "ajax"); ?>"
           class="btn btn-success">
           <i class="fas fa-file-excel me-2"></i>
           Exportar Excel
        </a>

    </div>

    <!-- Indicadores -->
    <div class="row">

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Total accidentes</small>
                <h4><?php echo $totalAcc; ?></h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Total lesionados</small>
                <h4><?php echo $totalLes; ?></h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Mes con m&aacute;s accidentes</small>
                <h4><?php echo $mesTop; ?></h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Casos pendientes</small>
                <h4><?php echo $pendientes; ?></h4>
            </div>
        </div>

    </div>

    
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <strong>Zonas de mayor accidentabilidad</strong>
        </div>

        <div class="card-body">

            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Zona </th>
                        <th>Accidentes</th>
                        <th>Lesionados</th>
                        <th>Riesgo</th>
                    </tr>
                </thead>

                <tbody>
                     
                    <!-- Aquí se valida si el arreglo $zonas no está vacío. Si contiene información, se mostrarán los registros en la tabla -->
                    <?php if(!empty($zonas)): ?>

                        <!-- Se crea una variable llamada $i y se inicializa en 1. Esta variable servirá para numerar las filas de la tabla -->
                        <?php $i = 1; ?>
                        <?php foreach($zonas as $z): ?>

                            <tr>
                                <!-- Se muestra el número consecutivo de la fila. El operador ++ hace que, después de mostrar el valor, aumente en uno para el siguiente registro -->
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $z['zona']; ?></td>
                                <td><?php echo $z['accidentes']; ?></td>
                                <td><?php echo $z['lesionados']; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $z['color']; ?>">
                                        <?php echo $z['riesgo']; ?>
                                    </span>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>  

                        <tr>
                            <td colspan="5" class="text-center">No hay datos disponibles</td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>