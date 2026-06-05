<?php
include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100">
            <div class="col-12 col-sm-10 col-lg-4 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-2">Recuperar Contraseña</h2>
                        <p class="text-center text-muted mb-4">
                            Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
                        </p>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                        <?php endif; ?>

                        <?php if (isset($_GET['exito'])): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($_GET['exito']) ?></div>
                        <?php endif; ?>

                        <form action="<?= getUrl('Acceso', 'Acceso', 'enviarCorreoRecuperacion', false, 'ajax') ?>" method="POST">
                            <label for="correo">Correo Electrónico</label>
                            <input
                                type="email"
                                class="form-control mb-3"
                                id="correo"
                                name="correo"
                                placeholder="correo@ejemplo.com"
                                required>
                            <button type="submit" class="btn btn-primary btn-block">
                                Enviar enlace
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