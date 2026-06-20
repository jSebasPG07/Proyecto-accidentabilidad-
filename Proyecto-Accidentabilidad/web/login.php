<?php
include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIAV - Iniciar Sesi&oacute;n</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            min-height:100vh;
            background: linear-gradient(135deg,#0b2f5b 0%,#154a8a 50%,#f4f7fb 100%);
        }

        .login-card{
            border:none;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(0,0,0,.20);
        }


        /* IZQUIERDA */
       
        .login-left{
            background:#0b2f5b;
            color:white;
            padding:80px 50px;
            border-right:1px solid rgba(255,255,255,.15);
            text-align:center;
        }

        .logo-giav{
            max-width:200px;
            margin-bottom:25px;
        }

        .info-giav{
            margin-top:10px;
        }

        .titulo-giav{
            font-size:3rem;
            font-weight:700;
            margin:0;
            margin-bottom:10px;
        }

        .descripcion-giav{
            color:rgba(255,255,255,.85);
            font-size:0.95rem;
            line-height:1.6;
            max-width:320px;
            margin:0 auto;
        }

        
        /* DERECHA */
        
        .login-right{
            background:white;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px;
        }

        .login-form-box{
            width:100%;
            max-width:360px;
        }

        .bienvenido{
            font-weight:700;
            color:#0b2f5b;
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

        .forgot{
            font-size:0.9rem;
            text-align:right;
            margin-top:-10px;
            margin-bottom:20px;
        }

        @media(max-width:768px){
            .login-left{
                display:none;
            }

            .login-right{
                padding:30px;
            }
        }

    </style>

</head>

<body>

<div class="container min-vh-100 d-flex align-items-center">

    <div class="row justify-content-center w-100">

        <div class="col-lg-11 col-xl-10">

            <div class="card login-card">

                <div class="row no-gutters">

                    <div class="col-md-6 login-left">

                        <img src="../img/logo_giavv.png"
                             alt="GIAV"
                             class="img-fluid logo-giav">

                        <div class="info-giav">

                            <h1 class="titulo-giav">GIAV</h1>
                            <p class="descripcion-giav">Geovisor Inteligente de Accidentabilidad Vial</p>

                        </div>

                    </div>

                    <div class="col-md-6 login-right">

                        <div class="login-form-box">

                            <h2 class="bienvenido text-center mb-2">Bienvenido</h2>

                            <p class="text-center text-muted mb-4">Inicia sesi&oacute;n para continuar</p>

                            <form action="<?php echo getUrl('Acceso','Acceso','login',false,'ajax'); ?>" method="POST">

                                <div class="form-group">
                                    <label>Correo Electr&oacute;nico</label>
                                    <input type="email" class="form-control" name="use_correo"
                                           placeholder="correo@ejemplo.com" required>
                                </div>

                                <div class="form-group">
                                    <label>Contrase&ntilde;a</label>
                                    <input type="password" class="form-control" name="use_clave"
                                           placeholder="Contrase&ntilde;a" required>
                                </div>

                                <div class="forgot">
                                    <a href="enviarCorreo.php">&iquest;Olvidaste tu contrase&ntilde;a?</a>
                                </div>

                                <button type="submit"
                                        class="btn btn-giav btn-block text-white">Iniciar Sesi&oacute;n</button>

                                <div class="text-center mt-4">
                                    <small>&iquest;No tienes una cuenta?
                                        <a href="<?php echo getUrl('Usuario','Usuario','getCreate',false,'ajax') ?>">Registrarse</a>
                                    </small>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>