<div class="mt-3">
    <h3 class="display-3">Formulario Solicitud Reductor En Mal Estado</h3>
</div>

<?php 
$datos = pg_fetch_assoc($reporte);
?>

<form action="<?php echo getUrl('Reportes', 'ReportesRME', 'postUpdate'); ?>"
      method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_sol_red_mal" value="<?php echo $datos['id_sol_red_mal']; ?>">

    <div class="row mt-5">

        <div class="col-md-4">
            <label>Tipo de reductor</label>
            <p class="form-control"><?php echo $datos['tipo_reductor'] ?></p>
        </div>

        <div class="col-md-4">
            <label>Tipo de da&ntilde;o</label>
            <p class="form-control"><?php echo $datos['tipo_dano'] ?></p>
        </div>

        <div class="col-md-4">
            <label>Direcci&oacute;n</label>
            <p class="form-control"><?php echo $datos['direccion'] ?></p>
        </div>

        <div class="col-md-4">
            <label>Descripci&oacute;n</label>
            <p class="form-control"><?php echo $datos['descripcion'] ?></p>
        </div>


        <div class="col-md-4 mt-3">
            <label>Imagen</label>
            <div>
                <?php if($datos['imagen_url'] != ""){ ?>
                    <img src="<?php echo $datos['imagen_url']; ?>" width="120">
                <?php } else { ?>
                    <p class="form-control">Sin imagen</p>
                <?php } ?>
            </div>
        </div>

        <div class="col-md-4">
            <label for="estado">Estado</label>
            <select name="id_estado" id="estado" class="form-control" required>
              <?php while ($est = pg_fetch_assoc($estados)) { ?>
            
            <option value="<?php echo $est['id_estado']; ?>"
                <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>>
                
                <?php echo $est['nombre']; ?>
            
            </option>

                <?php } ?>
            </select>
        </div>

        <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-success">Editar reporte</button>
        </div>

        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        </div>

    </div>

</form>