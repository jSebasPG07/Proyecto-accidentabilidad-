<?php
include_once '../lib/helpers.php';

if (!isset($_SESSION['recuperacion_verificada'])) {
    redirect('enviarCorreo.php');
    exit;
}

$error = '';

if (isset($_SESSION['error_nueva'])) {
    $error = $_SESSION['error_nueva'];
}

unset($_SESSION['error_nueva']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIAV - Nueva Contrase&ntilde;a</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            min-height:100vh;
            background: linear-gradient(
                135deg,
                #0b2f5b 0%,
                #154a8a 50%,
                #f4f7fb 100%
            );
        }

        .password-card{
            border:none;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(0,0,0,.20);
        }

        .password-box{
            background:white;
            padding:45px;
        }

        .titulo{
            font-weight:700;
            color:#0b2f5b;
            margin-bottom:10px;
        }

        .subtitulo{
            color:#6c757d;
            font-size:.95rem;
            margin-bottom:30px;
        }

        .form-group{
            margin-bottom:1.5rem;
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

        .footer-link{
            font-size:.9rem;
        }

    </style>

</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="row w-100">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5 mx-auto">

            <div class="card password-card">

                <div class="password-box">

                    <h3 class="titulo text-center">Nueva Contrase&ntilde;a</h3>

                    <p class="text-center subtitulo">Ingresa tu nueva contrase&ntilde;a para continuar.</p>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php } ?>

                    <form action="<?php echo getUrl('Acceso','Acceso','guardarContrasena',false,'ajax'); ?>" method="POST">

                        <div class="form-group">
                            <label for="nueva_contrasena">Nueva Contrase&ntilde;a</label>

                            <input
                                type="password"
                                class="form-control"
                                id="nueva_contrasena"
                                name="nueva_contrasena"
                                placeholder="M&iacute;nimo 8 caracteres"
                                minlength="8"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="confirmar_contrasena">Confirmar Contrase&ntilde;a</label>

                            <input
                                type="password"
                                class="form-control"
                                id="confirmar_contrasena"
                                name="confirmar_contrasena"
                                placeholder="Repite tu contrase&ntilde;a"
                                minlength="8"
                                required>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-giav btn-block text-white">Guardar Contrase&ntilde;a</button>

                    </form>

                    <div class="text-center mt-4 footer-link">

                        Volver al inicio de sesi&oacute;n

                        <a href="login.php"
                           class="font-weight-bold text-primary ml-1">Volver</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>