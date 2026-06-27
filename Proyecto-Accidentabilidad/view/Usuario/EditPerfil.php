<?php

$datos = pg_fetch_assoc($usuario);
$id_rol = $_SESSION['id_rol'];

?>

<div class="container mt-4">

    <h3>Editar Mi Perfil</h3>

    <hr>

    <?php if (isset($_SESSION['error_perfil'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error_perfil']; unset($_SESSION['error_perfil']); ?></div>
    <?php endif; ?>

    <div class="card">

        <div class="card-body">

            <form action="<?php echo getUrl("Usuario", "Usuario", "postPerfil"); ?>" method="post">

                <div class="row">

                    <!-- Nombre y Apellido: solo Funcionario y Administrador -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Nombre</label>
                        <?php if ($id_rol == 2 || $id_rol == 3): ?>
                            <input type="text" class="form-control" name="nombre"
                                   value="<?php echo $datos['nombre']; ?>" required>
                        <?php else: ?>
                            <p class="form-control-plaintext"><?php echo $datos['nombre']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Apellido</label>
                        <?php if ($id_rol == 2 || $id_rol == 3): ?>
                            <input type="text" class="form-control" name="apellido"
                                   value="<?php echo $datos['apellido']; ?>" required>
                        <?php else: ?>
                            <p class="form-control-plaintext"><?php echo $datos['apellido']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tipo y numero de documento: solo lectura para todos, solo Admin podria cambiarlos pero no se pidio -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Tipo de Documento</label>
                        <p class="form-control-plaintext"><?php echo $datos['nombre_tipo_doc']; ?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">N&uacute;mero de Documento</label>
                        <p class="form-control-plaintext"><?php echo $datos['numero_id']; ?></p>
                    </div>

                    <!-- Correo: solo lectura, no se pidio que fuera editable para ningun rol salvo Admin (todo) -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Correo</label>
                            <input type="email" class="form-control" name="correo"
                                   value="<?php echo $datos['correo']; ?>" required>
                    </div>

                    <!-- Telefono: datos de contacto, todos los roles pueden editar -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Tel&eacute;fono</label>
                        <input type="text" class="form-control" name="telefono"
                               value="<?php echo $datos['telefono']; ?>" required>
                    </div>

                    <!-- Direccion: datos de contacto, todos los roles pueden editar -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Direcci&oacute;n</label>
                        <input type="text" class="form-control" name="direccion"
                               value="<?php echo $datos['direccion']; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Rol</label>
                        <p class="form-control-plaintext"><?php echo $datos['nombre_rol']; ?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Estado</label>
                        <p class="form-control-plaintext"><?php echo $datos['nombre_estado']; ?></p>
                    </div>

                </div>

                <!-- Cambio de contraseña: solo Ciudadano y Administrador -->
                <?php if ($id_rol == 1 || $id_rol == 2): ?>

                    <hr>
                    <h5>Cambiar Contrase&ntilde;a</h5>
                    <p class="text-muted small">Deja estos campos en blanco si no deseas cambiar tu contrase&ntilde;a.</p>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Contrase&ntilde;a Actual</label>
                            <input type="password" class="form-control" name="contrasena_actual"
                                   autocomplete="current-password">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Nueva Contrase&ntilde;a</label>
                            <input type="password" class="form-control" name="contrasena_nueva"
                                   minlength="8" autocomplete="new-password">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="fw-bold">Confirmar Nueva Contrase&ntilde;a</label>
                            <input type="password" class="form-control" name="contrasena_confirmar"
                                   minlength="8" autocomplete="new-password">
                        </div>

                    </div>

                <?php endif; ?>

                <button type="submit" class="btn btn-success mt-3">
                    Guardar Cambios
                </button>

                <a href="<?php echo getUrl("Usuario", "Usuario", "perfil"); ?>" class="btn btn-secondary mt-3">
                    Cancelar
                </a>

            </form>

        </div>

    </div>

</div>
