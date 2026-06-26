<?php

$datos = pg_fetch_assoc($usuario);

?>

<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-user-circle" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Detalle del Usuario</h4>
            <small class="text-muted">Consulta la informaci&oacute;n completa del usuario seleccionado.</small>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-white border-0">
            <h4 class="mb-0 text-primary font-weight-bold">Informaci&oacute;n del Usuario</h4>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>ID:</strong><br>
                    <?php echo $datos['id']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Documento:</strong><br>
                    <?php echo $datos['numero_id']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Nombre:</strong><br>
                    <?php echo $datos['nombre']." ".$datos['apellido']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Correo Electr&oacute;nico:</strong><br>
                    <?php echo $datos['correo']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Tel&eacute;fono:</strong><br>
                    <?php echo $datos['telefono']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Direcci&oacute;n:</strong><br>
                    <?php echo $datos['direccion']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Rol:</strong><br>
                    <?php echo $datos['nombre_rol']; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Estado:</strong><br>

                    <?php
                        $estado = trim($datos['estado']);

                        if($estado == 'Habilitado'){
                            $clase = 'badge badge-success';
                        }
                        elseif($estado == 'Inhabilitado'){
                            $clase = 'badge badge-danger';
                        }
                    ?>

                    <span class="<?php echo $clase; ?>">
                        <?php echo $datos['estado']; ?>
                    </span>

                </div>

            </div>

        </div>

        <div class="card-footer bg-white">

            <a class="btn btn-primary"
               href="<?php echo getUrl("Usuario","GestionUsuario","getList"); ?>">
                <i class="fas fa-arrow-left me-2"></i>
                Volver
            </a>

        </div>

    </div>

</div>