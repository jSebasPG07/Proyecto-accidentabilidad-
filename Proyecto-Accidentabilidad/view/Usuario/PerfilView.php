<?php

$datos = pg_fetch_assoc($usuario);

?>

<div class="container mt-4">

    <h3>Mi Perfil</h3>

    <hr>

    <?php if (isset($_SESSION['exito_perfil'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['exito_perfil']; unset($_SESSION['exito_perfil']); ?></div>
    <?php endif; ?>

    <div class="card">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nombre</label>
                    <p><?php echo $datos['nombre']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Apellido</label>
                    <p><?php echo $datos['apellido']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tipo de Documento</label>
                    <p><?php echo $datos['nombre_tipo_doc']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">N&uacute;mero de Documento</label>
                    <p><?php echo $datos['numero_id']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Correo</label>
                    <p><?php echo $datos['correo']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tel&eacute;fono</label>
                    <p><?php echo $datos['telefono']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Direcci&oacute;n</label>
                    <p><?php echo $datos['direccion']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Rol</label>
                    <p><?php echo $datos['nombre_rol']; ?></p>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Estado</label>
                    <p><?php echo $datos['nombre_estado']; ?></p>
                </div>

            </div>

            <a href="<?php echo getUrl("Usuario", "Usuario", "getEditPerfil"); ?>" class="btn btn-primary">
                Editar
            </a>

        </div>

    </div>

</div>
