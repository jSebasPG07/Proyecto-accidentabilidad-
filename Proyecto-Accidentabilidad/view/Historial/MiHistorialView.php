<div class="mb-3">
    <label>Filtrar por tipo de reporte</label>

    <select id="filtro" class="form-control"
        data-url="<?php echo getUrl("Historial","MiHistorial","getFiltrar"); ?>">

        <option value="accidente">Reporte Accidente</option>
        <option value="senal_nueva">Solicitud nueva señal</option>
        <option value="senal_mal">Solicitud señal en mal estado</option>
        <option value="reductor_nuevo">Solicitud nuevo reductor</option>
        <option value="reductor_mal">Solicitud reductor en mal estado</option>
        <option value="via_mal">Solicitud vía en mal estado</option>
    </select>
</div>

<div id="resultado"></div>

<div class="mt-5">
    <h3 class="display-4">Listado de Accidentes</h3>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Nomenclatura</th>
            <th>Lesionados</th>
            <th>Observaciones</th>
            <th>Dirección</th>
            <th>Tipo Choque</th>
            <th>Imagen</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($accidentes as $a){ ?>
            <tr>
                <td><?= $a['id_reporte_acc'] ?></td>
                <td><?= $a['fecha_accidente'] ?></td>
                <td><?= $a['nomenclatura'] ?></td>
                <td><?= $a['num_lesionados'] ?></td>
                <td><?= $a['observaciones'] ?></td>
                <td><?= $a['direccion'] ?></td>
                <td><?= $a['tipo_choque'] ?></td>
                <td>
                    <?php if($a['imagen_url'] != ""){ ?>
                        <img src="<?= $a['imagen_url'] ?>" width="80">
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once "../view/partials/script.php"; ?>
