<?php

$datos = pg_fetch_assoc($usuario);

?>

<div class="container-fluid mt-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-warning rounded-3 d-flex align-items-center justify-content-center"
             style="width:54px;height:54px;flex-shrink:0;">
            <i class="fas fa-user-edit" style="font-size:1.4rem;color:#fff;"></i>
        </div>

        <div>
            <h4 class="mb-0 fw-bold">Editar Usuario</h4>
            <small class="text-muted">Modifica la informaci&oacute;n del usuario.
            </small>
        </div>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form action="<?php echo getUrl("Usuario","GestionUsuario","postUpdate"); ?>"
                  method="post">

                <input type="hidden"
                       name="id"
                       value="<?php echo $datos['id']; ?>">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nombre</label>

                        <input type="text"
                               class="form-control"
                               name="nombre"
                               value="<?php echo $datos['nombre']; ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Apellido</label>

                        <input type="text"
                               class="form-control"
                               name="apellido"
                               value="<?php echo $datos['apellido']; ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Correo Electr&oacute;nico</label>

                        <input type="email"
                               class="form-control"
                               name="correo"
                               value="<?php echo $datos['correo']; ?>"
                               required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Rol</label>

                        <select name="id_rol"
                                class="form-control">

                            <?php while($rol = pg_fetch_assoc($roles)){ ?>

                                <option value="<?php echo $rol['id_rol']; ?>"
                                    <?php
                                        if($rol['id_rol'] == $datos['id_rol']){
                                            echo "selected";
                                        }
                                    ?>>
                                    <?php echo $rol['nombre_rol']; ?>
                                </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Estado</label>

                        <select name="id_estado"
                                class="form-control">

                            <?php while($estado = pg_fetch_assoc($estados)){ ?>

                                <option value="<?php echo $estado['id_estado']; ?>"
                                    <?php
                                        if($estado['id_estado'] == $datos['id_estado']){
                                            echo "selected";
                                        }
                                    ?>>
                                    <?php echo $estado['nombre']; ?>
                                </option>

                            <?php } ?>

                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit"
                            class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>
                        Guardar Cambios
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>