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

$msg = '';
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

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2E6EB5 0%, #5A9BE6 50%, #F4F7FB 100%);
        }

        .verify-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .20);
        }

        .verify-box {
            padding: 45px 40px;
        }

        .title {
            font-weight: 700;
            color: #0b2f5b;
        }

        .form-control {
            height: 48px;
            border-radius: 10px;
            letter-spacing: 4px;
            font-size: 1.2rem;
        }

        .btn-giav {
            background: #0b2f5b;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-giav:hover {
            background: #154a8a;
        }

        .text-muted-small {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">

    <div class="row w-100">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5 mx-auto">

            <div class="card verify-card">

                <div class="verify-box">

                    <h3 class="title text-center mb-2">Verificar Código</h3>

                    <p class="text-center text-muted text-muted-small mb-4">Ingresa el código de 6 dígitos enviado a tu correo.</p>

                    <?php if ($msg): ?>
                        <div class="alert alert-success text-center">
                            <?= htmlspecialchars($msg) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= getUrl('Acceso', 'Acceso', 'validarCodigo', false, 'ajax') ?>" method="POST">

                        <div class="form-group">
                            <label>Código de verificación</label>
                            <input type="text"
                                   class="form-control text-center"
                                   name="codigo"
                                   maxlength="6"
                                   pattern="\d{6}"
                                   placeholder="000000"
                                   autocomplete="off"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-giav btn-block text-white">Verificar código</button>

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