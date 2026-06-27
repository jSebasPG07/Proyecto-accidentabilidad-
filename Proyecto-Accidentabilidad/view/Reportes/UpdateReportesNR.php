<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-road" style="font-size:1.4rem;color:#fff;"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Solicitud Nuevo Reductor</h4>
            <p class="text-muted mb-0 small">Registra la solicitud de instalaci&oacute;n de un nuevo reductor de velocidad</p>
        </div>
    </div>

    <!-- Card -->
    <div class="card border shadow-sm">
        <div class="card-body p-4">

             <?php 
                $datos = pg_fetch_assoc($reporte);
            ?>

            <form action="<?php echo getUrl('Reportes','ReportesSolicitudNR','postUpdate');?>"
                  method="post" enctype="multipart/form-data">

                  <input type="hidden" name="id_sol_nuevas_red" value="<?php echo $datos['id_sol_nuevas_red']; ?>"> <!-- Guarda el ID de la solicitud para enviarlo junto con el formulario. -->

                <div class="row g-3">

                    
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="id_tipo_reductor">Tipo de Reductor</label>
                        <p class="form-control"><?php echo $datos['tipo_reductor'] ?></p> <!-- Se muestra el tipo de reductor registrado en la solicitud. -->
                    </div>

                    <!-- Tipo de Daño -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="id_tipo_dano">Tipo de da&ntilde;o</label>
                        <p class="form-control"><?php echo $datos['tipo_dano_reductor'] ?></p> <!-- Se muestra el tipo de daño del reductor registrado en la solicitud. -->
                    </div>
                    <!-- Dirección -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="direccion">Direccion</label>
                        <p class="form-control"><?php echo $datos['direccion'] ?></p> <!-- Se muestra la dirección registrada en la solicitud. -->
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="referencia">Referencia</label>
                        <p class="form-control"><?php echo $datos['referencia'] ?></p> <!-- Se muestra la referencia registrada en la solicitud. -->
                    </div>

                    <!-- Imagen -->
                    <div class="col-12 col-md-6">
                         <label>Imagen</label>
                        <div>
                            <?php if($datos['imagen_url'] != ""){ ?> // Se verifica si la solicitud tiene una imagen registrada.
                                <img src="<?php echo $datos['imagen_url']; ?>" width="120">   <!-- Si existe una imagen, se muestra en pantalla. -->
                            <?php } else { ?>
                                <p class="form-control">Sin imagen</p> //Si no hay
                            <?php } ?>
                        </div>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Descripci&oacute;n</label>
                        <p class="form-control"><?php echo $datos['descripcion'] ?></p> <!-- Se muestra la descripción registrada en la solicitud. -->
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold" for="descripcion">Estado</label>
                        <select name="id_estado" id="estado" class="form-control" required>
                            <?php while ($est = pg_fetch_assoc($estados)) { ?> //recorre uno de los registros obtenidos de una consulta, extrae una fila como arreglo y la guarda en la variable $est
            
                        <option value="<?php echo $est['id_estado']; ?>"
                            <?php if($datos['estado'] == $est['nombre']) echo "selected"; ?>> //Verifica si el estado actual almacenado en $datos['estado'] es igual al nombre del estado de la opción que se está recorriendo ($est['nombre'])
                
                            <?php echo $est['nombre']; ?>
            
                        </option>

                            <?php } ?>
                        </select>
                    </div>
                    <!-- Botones -->
                    <div class="col-12 d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Registrar nuevo reductor</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>"> <!-- Guarda el ID del usuario que inició sesión para enviarlo con el formulario. -->

                </div>

            </form>

        </div>
    </div>

</div>

<?php include_once "../view/partials/script.php"; ?>