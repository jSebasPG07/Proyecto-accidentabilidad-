<div class="container-fluid mt-4">

    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Zona Mayor Accidentabilidad</h3>

        <a href="<?php echo getUrl("Estadisticas","ZonaMayAccidentabilidad","exportarExcel", false, "ajax"); ?>" class="btn btn-success">
            Exportar Excel
        </a>
    </div>

    
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
                <h4>
                    <?php echo isset($pendientes) ? $pendientes : 0; ?>
                </h4>
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

                     
                    <?php if(!empty($zonas)): ?>

                        <?php $i = 1; ?>
                        <?php foreach($zonas as $z): ?>

                            <tr>
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
                            <td colspan="5" class="text-center">
                                No hay datos disponibles
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>

</div>