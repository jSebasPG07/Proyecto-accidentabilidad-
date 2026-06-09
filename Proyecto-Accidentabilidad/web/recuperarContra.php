<?php
include_once '../lib/helpers.php';


if (!isset($_SESSION['recuperacion_verificada'])) {
    redirect('enviarCorreo.php');
    exit;
}

$error = $_SESSION['error_nueva'] ?? '';
unset($_SESSION['error_nueva']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100">
            <div class="col-12 col-sm-10 col-lg-4 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Nueva Contraseña</h2>

                        <?php if ($error){ ?>
                            <div class="alert alert-danger"><?php htmlspecialchars($error) ?></div>
                        <?php }; ?>

                        <form action="<?= getUrl('Acceso', 'Acceso', 'guardarContrasena', false, 'ajax') ?>" method="POST">

                            <label for="nueva_contrasena">Nueva Contraseña</label>
                            <input
                                type="password"
                                class="form-control mb-3"
                                id="nueva_contrasena"
                                name="nueva_contrasena"
                                placeholder="Mínimo 8 caracteres"
                                required minlength="8">

                            <label for="confirmar_contrasena">Confirmar Contraseña</label>
                            <input
                                type="password"
                                class="form-control mb-3"
                                id="confirmar_contrasena"
                                name="confirmar_contrasena"
                                placeholder="Repite tu contraseña"
                                required minlength="8">

                            <button type="submit" class="btn btn-success btn-block">
                                Guardar contraseña
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="login.php">← Volver al inicio de sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
