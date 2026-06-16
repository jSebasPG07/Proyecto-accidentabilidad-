<?php
include_once '../lib/helpers.php';

// CORRECCIÓN 5: el redirect de la guardia debe ser relativo a web/
if (!isset($_SESSION['id_usuario_recuperacion'])) {
    redirect('enviarCorreo.php');
    exit;
}

$error = '';
if (isset($_SESSION['error_verificacion'])) {
    $error = $_SESSION['error_verificacion'];
}
$msg   = '';
if (isset($_SESSION['msg_recuperacion'])) {
    $msg = $_SESSION['msg_recuperacion'];
}
unset($_SESSION['error_verificacion'], $_SESSION['msg_recuperacion']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100">
            <div class="col-12 col-sm-10 col-lg-4 mx-auto">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-2">Verificar Código</h2>
                        <p class="text-center text-muted mb-4">
                            Ingresa el código de 6 dígitos que enviamos a tu correo. Válido por 15 minutos.
                        </p>

                        <?php if ($msg): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
                        <?php endif; ?>

                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form action="<?= getUrl('Acceso', 'Acceso', 'validarCodigo', false, 'ajax') ?>" method="POST">
                            <label for="codigo">Código de verificación</label>
                            <input
                                type="text"
                                class="form-control mb-3 text-center"
                                id="codigo"
                                name="codigo"
                                placeholder="000000"
                                maxlength="6"
                                pattern="\d{6}"
                                autocomplete="off"
                                required>
                            <button type="submit" class="btn btn-primary btn-block">
                                Verificar código
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="enviarCorreo.php">← Solicitar un nuevo código</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
