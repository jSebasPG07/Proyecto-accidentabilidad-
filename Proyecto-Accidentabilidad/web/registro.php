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

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="numero1">N&uacute;mero de via</label>
                                    <input type="number" class="form-control direccion" id="numero1" name="numero1"maxlength="3" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="cuadrante">Cuadrante</label>
                                    <select class="form-control direccion" id="cuad1" name="cuad1">
                                        <option value=""></option>
                                        <option>Norte</option>
                                        <option>Sur</option>
                                        <option>Oriente</option>
                                        <option>Oeste</option>
                                    </select>
                                </div>

                                
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="complemento"> Complemento</label>
                                    <select class="form-control direccion" id="comp2" name="comp2">
                                        <option value="">Ninguno</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                        <option>F</option>
                                        <option>G</option>
                                        <option>H</option>
                                        <option>I</option>
                                        <option>J</option>
                                        <option>K</option>
                                        <option>L</option>
                                        <option>M</option>
                                        <option>N</option>
                                        <option>O</option>
                                        <option>P</option>
                                        <option>Q</option>
                                        <option>R</option>
                                        <option>S</option>
                                        <option>T</option>
                                        <option>U</option>
                                        <option>V</option>
                                        <option>W</option>
                                        <option>X</option>
                                        <option>Y</option>
                                        <option>Z</option>
                                        <option>Bis</option>
                                        <option>Bis A</option>
                                        <option>Bis B</option>
                                        <option>Bis C</option>
                                        <option>Bis D</option>
                                        <option>Bis E</option>
                                        <option>Bis F</option>
                                        <option>Bis G</option>
                                        <option>Bis H</option>
                                        <option>Bis I</option>
                                        <option>Bis J</option>
                                        <option>Bis K</option>
                                        <option>Bis L</option>
                                        <option>Bis M</option>
                                        <option>Bis N</option>
                                        <option>Bis O</option>
                                        <option>Bis P</option>
                                        <option>Bis Q</option>
                                        <option>Bis R</option>
                                        <option>Bis S</option>
                                        <option>Bis T</option>
                                        <option>Bis U</option>
                                        <option>Bis V</option>
                                        <option>Bis W</option>
                                        <option>Bis X</option>
                                        <option>Bis Y</option>
                                        <option>Bis Z</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="numero3">Número de predio</label>
                                    <input type="number" class="form-control direccion" id="numero3" name="numero3" maxlength="3" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="barrio">Barrio</label>
                                    <select name="barrio" id="barrio" class="form-control direccion" required>

                                            <option value="">Seleccione...</option>
                        
                                        <?php while ($barrio = pg_fetch_assoc($barrios)) { ?> 
                                            <option value="<?php echo $barrio['id_barrio']; ?>"> 
                                        <?php echo $barrio['nombre']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
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
                                    <input type="password" class="form-control" name="contrasena" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="tipovia">Tipo de via</label>
                                    <select id="tipo_via" name="tipo_via" class="form-control" required> 
                                        <option value="">Ninguno</option>                
                                        <option value="Calle">Calle</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Avenida">Avenida</option>
                                        <option value="Diagonal">Diagonal</option>
                                        <option value="Transversal">Transversal</option>
                                        <option value="Circular">Circular</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="complemento">Complemento</label>
                                    <select class="form-control direccion" id="comp1" name="comp1">
                                        <option value="">Ninguno</option>
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                        <option>F</option>
                                        <option>G</option>
                                        <option>H</option>
                                        <option>I</option>
                                        <option>J</option>
                                        <option>K</option>
                                        <option>L</option>
                                        <option>M</option>
                                        <option>N</option>
                                        <option>O</option>
                                        <option>P</option>
                                        <option>Q</option>
                                        <option>R</option>
                                        <option>S</option>
                                        <option>T</option>
                                        <option>U</option>
                                        <option>V</option>
                                        <option>W</option>
                                        <option>X</option>
                                        <option>Y</option>
                                        <option>Z</option>
                                        <option>Bis</option>
                                        <option>Bis A</option>
                                        <option>Bis B</option>
                                        <option>Bis C</option>
                                        <option>Bis D</option>
                                        <option>Bis E</option>
                                        <option>Bis F</option>
                                        <option>Bis G</option>
                                        <option>Bis H</option>
                                        <option>Bis I</option>
                                        <option>Bis J</option>
                                        <option>Bis K</option>
                                        <option>Bis L</option>
                                        <option>Bis M</option>
                                        <option>Bis N</option>
                                        <option>Bis O</option>
                                        <option>Bis P</option>
                                        <option>Bis Q</option>
                                        <option>Bis R</option>
                                        <option>Bis S</option>
                                        <option>Bis T</option>
                                        <option>Bis U</option>
                                        <option>Bis V</option>
                                        <option>Bis W</option>
                                        <option>Bis X</option>
                                        <option>Bis Y</option>
                                        <option>Bis Z</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="numero2">Número después del #</label>
                                    <input type="number" class="form-control direccion" id="numero2" name="numero2" maxlength="3" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="cuadrante">Cuadrante</label>
                                    <select class="form-control direccion" id="cuad2" name="cuad2">
                                        <option value="">Ninguno</option>
                                        <option>Norte</option>
                                        <option>Sur</option>
                                        <option>Este</option>
                                        <option>Oeste</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="direccion"> Dirección completa</label>
                                    <input type="text" class="form-control bg-light" id="direccionPreview" readonly>
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
<?php include_once "../view/partials/script.php"; ?>