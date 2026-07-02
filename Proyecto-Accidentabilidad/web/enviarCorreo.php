<?php
include_once '../lib/helpers.php';

// Mostrar error si lo hay y limpiarlo de sesión
$error = "";
if (isset($_SESSION['error_recuperacion'])) {
    $error = $_SESSION['error_recuperacion'];
}
unset($_SESSION['error_recuperacion']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIAV - Recuperar Contraseña</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            min-height:100vh;
            background: linear-gradient(135deg, #2E6EB5 0%, #5A9BE6 50%, #F4F7FB 100%);
        }

        .recover-card{
            border:none;
            border-radius:18px;
            box-shadow:0 20px 50px rgba(0,0,0,.20);
            overflow:hidden;
        }

        .recover-box{
            padding:60px 45px;
            background:white;
        }

        .titulo{
            font-weight:700;
            color:#0b2f5b;
        }

        .subtitulo{
            font-size:0.95rem;
            color:#6c757d;
        }

        .form-control{
            height:48px;
            border-radius:10px;
        }

        .btn-giav{
            background:#0b2f5b;
            border:none;
            border-radius:10px;
            font-weight:600;
            padding:10px;
        }

        .btn-giav:hover{
            background:#154a8a;
        }

        .volver{
            font-size:0.9rem;
        }

    </style>

</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="row w-100">

        <div class="col-12 col-sm-10 col-md-6 col-lg-4 mx-auto">

            <div class="card recover-card">

                <div class="recover-box">

                    <h3 class="titulo text-center mb-2">
                        Recuperar Contraseña
                    </h3>

                    <p class="text-center subtitulo mb-4">
                        Ingresa tu correo y te enviaremos un código para restablecer tu contraseña.
                    </p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= getUrl('Acceso','Acceso','enviarCodigo',false,'ajax') ?>" method="POST">

                        <div class="form-group">

                            <label for="correo">
                                Correo Electrónico
                            </label>

                            <input type="email"
                                   class="form-control"
                                   id="correo"
                                   name="correo"
                                   placeholder="correo@ejemplo.com"
                                   required>

                        </div>

                        <button type="submit"
                                class="btn btn-giav btn-block text-white">
                            Enviar código
                        </button>

                    </form>

                    <div class="text-center mt-4 volver">
                        <a href="login.php">
                            ← Volver al inicio de sesión
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>