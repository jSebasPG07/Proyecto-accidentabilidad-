<?php
include_once '../lib/helpers.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - GIAV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100 py-4">
    <div class="card shadow-lg rounded-4 p-4 border-0 w-100 mx-3" style="max-width:420px;">

        <div class="text-center mb-4">
            <img src="assets/img/giav.png" alt="GIAV" width="90" height="90" class="img-fluid">
        </div>
        <h2 class="text-center mb-4">Crea una cuenta</h2>

        <form action="<?php echo getUrl('Usuario', 'Usuario', 'postCreate', false, 'ajax') ?>" method="POST">

            <div class="mb-3">
                <label for="tipo_documento" class="form-label">Tipo de documento</label>
                <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                    <option value="" disabled selected>Seleccione el tipo de documento</option>
                    <?php foreach ($tipo as $tip){ ?>
                        <option value="<?php echo $tip['id_tipo_doc'] ?>">
                            <?php echo $tip['descripcion'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="numero_documento" class="form-label">Numero de documento</label>
                <input type="text" class="form-control" id="numero_documento" name="numero_documento"
                    placeholder="Ingrese el numero de documento" required>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Ingrese sus nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    placeholder="Ingrese su nombre" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Ingrese sus apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido"
                    placeholder="Ingrese sus apellidos" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Ingrese su numero de telefono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                    placeholder="Ingrese su numero de telefono" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Ingrese su correo electronico</label>
                <input type="email" class="form-control" id="correo" name="correo"
                    placeholder="Ingrese su correo electronico" required>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Crea una contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena"
                    placeholder="Minimo 8 caracteres, una mayuscula y un caracter" minlength="8" required>
            </div>

            <div class="mb-4">
                <label for="direccion" class="form-label">Ingrese su dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    placeholder="Ej: Cra 49 Oe # 49-10" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Registrarse</button>

        </form>

        <div class="text-center footer-link">
            Volver al inicio de sesión <a href="login.php" class="fw-semibold text-primary ms-1 text-decoration-none">Volver</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
