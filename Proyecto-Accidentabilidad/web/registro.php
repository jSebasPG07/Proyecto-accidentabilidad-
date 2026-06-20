<?php
include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIAV - Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            min-height:100vh;
            background: linear-gradient(135deg,#0b2f5b 0%,#154a8a 50%,#f4f7fb 100%);
        }

        .register-card{
            border:none;
            border-radius:18px;
            box-shadow:0 20px 50px rgba(0,0,0,.20);
            overflow:hidden;
        }

        .register-box{
            background:white;
            padding:40px 45px;
        }

        .titulo{
            font-weight:700;
            color:#0b2f5b;
            margin-bottom:20px;
        }

        .form-control{
            height:46px;
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

        .logo{
            width:140px;
            margin-bottom:15px;
            filter: drop-shadow(0 6px 10px rgba(0,0,0,0.2));
        }

        .footer-link{
            font-size:0.9rem;
        }

    </style>

</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="row w-100">

        <div class="col-12 col-lg-8 mx-auto">

            <div class="card register-card">

                <div class="register-box">

                    <!-- LOGO -->
                    <div class="text-center">
                        <img src="../img/logo_giavv.png" class="logo" alt="GIAV">
                    </div>

                    <h3 class="titulo text-center">
                        Crear cuenta
                    </h3>

                    <form action="<?php echo getUrl('Usuario','Usuario','postCreate',false,'ajax') ?>" method="POST">

                        <div class="row">

                            <!-- IZQUIERDA -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <select class="form-control" name="tipo_documento" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($tipo as $tip){ ?>
                                            <option value="<?php echo $tip['id_tipo_doc'] ?>">
                                                <?php echo $tip['descripcion'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>

                                <div class="form-group">
                                    <label>Correo electr&oacute;nico</label>
                                    <input type="email" class="form-control" name="correo" required>
                                </div>

                                <div class="form-group">
                                    <label>Tel&eacute;fono</label>
                                    <input type="tel" class="form-control" name="telefono" required>
                                </div>

                            </div>

                            <!-- DERECHA -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>N&uacute;mero de documento</label>
                                    <input type="text" class="form-control" name="numero_documento" required>
                                </div>

                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" name="apellido" required>
                                </div>

                                <div class="form-group">
                                    <label>Contrase&ntilde;a</label>
                                    <input type="password" class="form-control" name="contrasena" minlength="8" required>
                                </div>

                                <div class="form-group">
                                    <label>Direcci&oacute;n</label>
                                    <input type="text" class="form-control" name="direccion" required>
                                </div>

                            </div>

                        </div>

                        <!-- BOTÓN -->
                        <button type="submit" class="btn btn-giav btn-block text-white mt-3">Registrarse</button>

                    </form>

                    <!-- LINK -->
                    <div class="text-center mt-3 footer-link">
                        Volver al inicio de sesi&oacute;n
                        <a href="login.php" class="font-weight-bold text-primary ml-1">Volver</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>