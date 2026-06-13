<?php

$datos = pg_fetch_assoc($usuario);

?>

<div class="container mt-4">

    <h3>Editar Usuario</h3>

    <hr>

    <form action="<?php echo getUrl("Usuario","GestionUsuario","postUpdate"); ?>"
          method="post">

        <input type="hidden"
               name="id"
               value="<?php echo $datos['id']; ?>">

        <div class="form-group">

            <label>Nombre</label>

            <input type="text"
                   class="form-control"
                   name="nombre"
                   value="<?php echo $datos['nombre']; ?>"
                   required>

        </div>

        <div class="form-group mt-3">

            <label>Apellido</label>

            <input type="text"
                   class="form-control"
                   name="apellido"
                   value="<?php echo $datos['apellido']; ?>"
                   required>

        </div>

        <div class="form-group mt-3">

            <label>Correo</label>

            <input type="email"
                   class="form-control"
                   name="correo"
                   value="<?php echo $datos['correo']; ?>"
                   required>

        </div>

        <div class="form-group mt-3">

            <label>Rol</label>

            <select name="id_rol"
                    class="form-control">

                <?php while($rol = pg_fetch_assoc($roles)){ ?>

                    <option value="<?php echo $rol['id_rol']; ?>"

                    <?php
                        if($rol['id_rol'] == $datos['id_rol']){
                            echo "selected";
                        }
                    ?>

                    >

                        <?php echo $rol['nombre_rol']; ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <div class="form-group mt-3">

            <label>Estado</label>

            <select name="id_estado"
                    class="form-control">

                <?php while($estado = pg_fetch_assoc($estados)){ ?>

                    <option value="<?php echo $estado['id_estado']; ?>"

                    <?php
                        if($estado['id_estado'] == $datos['id_estado']){
                            echo "selected";
                        }
                    ?>

                    >

                        <?php echo $estado['nombre']; ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <button type="submit"
                class="btn btn-success mt-4">

            Guardar Cambios

        </button>

    </form>

</div>