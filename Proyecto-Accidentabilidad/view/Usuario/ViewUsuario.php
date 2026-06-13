<?php

$datos = pg_fetch_assoc($usuario);

?>

<div class="container mt-4">

    <h3>Detalle Usuario</h3>

    <hr>

    <p><strong>ID:</strong> <?php echo $datos['id']; ?></p>

    <p><strong>Documento:</strong> <?php echo $datos['numero_id']; ?></p>

    <p><strong>Nombre:</strong>
        <?php echo $datos['nombre']." ".$datos['apellido']; ?>
    </p>

    <p><strong>Correo:</strong> <?php echo $datos['correo']; ?></p>

    <p><strong>Teléfono:</strong> <?php echo $datos['telefono']; ?></p>

    <p><strong>Dirección:</strong> <?php echo $datos['direccion']; ?></p>

    <p><strong>Rol:</strong> <?php echo $datos['nombre_rol']; ?></p>

    <p><strong>Estado:</strong> <?php echo $datos['estado']; ?></p>

    <a class="btn btn-secondary"
       href="<?php echo getUrl("Usuario","GestionUsuario","getList"); ?>">

        Volver

    </a>

</div>