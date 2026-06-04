<?php
include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class = bg-light>
    <div class = "container d-flex justify-content-center align-items-center min-vh-100">
        <div class= "row w-100">
            <div class = "col-12 col-sm-10 col-lg-4 mx-auto">
                <div class = "card shadow-ig border-0 rounded-lg">
                    <div class = "card-body p-4">
                        <h2 class = "text-center mb-4">Iniciar Sesión</h2>
                        <form action="<?php echo getUrl("Acceso", "Acceso", "login", false, "ajax"); ?>" method="POST">
                            <label for="email">Correo Electrónico</label>
                            <div>
                                <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="use_correo"
                                placeholder="correo@ejemplo.com"
                                required>
                            </div>
                            <label for="password">Contraseña</label>
                            <div>
                                <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="use_clave"
                                placeholder="Contraseña"
                                required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button> 
                            </div>
                        </form>

                </div>

            </div>

        </div>
        
        
    </div>
    
  
</body>
</html>
