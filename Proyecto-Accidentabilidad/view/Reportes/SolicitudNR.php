<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GIAV - Reporte Reductores</title>
</head>
<body>

    <h2>Formulario de Solicitud de Reductores</h2>

    <table border="0" width="100%">
        <tr>
            <td width="35%" valign="top">
                
                <h3>
                    <?php if (isset($solicitud)) { echo "Modificar Solicitud"; } else { echo "Registrar Solicitud"; } ?>
                </h3>

                <?php 
                    // Cambiar el destino del formulario según la acción
                    if (isset($solicitud)) {
                        $urlAccion = "index.php?c=SolicitudNR&a=actualizar";
                        $registro = $solicitud[0]; // Extraer el registro para editar
                    } else {
                        $urlAccion = "index.php?c=SolicitudNR&a=crear";
                        $registro = null;
                    }
                ?>
                
                <form action="<?php echo $urlAccion; ?>" method="POST" enctype="multipart/form-data">
                    
                    <?php if ($registro != null) { ?>
                        <input type="hidden" name="id_sol_nuevas_red" value="<?php echo $registro['id_sol_nuevas_red']; ?>">
                    <?php } ?>

                    <p>
                        <label>Tipo de Reductor:</label><br>
                        <select name="id_tipo_reductor" required>
                            <option value="">Seleccione...</option>
                            <option value="1" <?php if($registro != null && $registro['id_tipo_reductor'] == 1) { echo "selected"; } ?>>Resalto Parabólico</option>
                            <option value="2" <?php if($registro != null && $registro['id_tipo_reductor'] == 2) { echo "selected"; } ?>>Banda Sonora</option>
                            <option value="3" <?php if($registro != null && $registro['id_tipo_reductor'] == 3) { echo "selected"; } ?>>Stoper / Tachón</option>
                        </select>
                    </p>

                    <p>
                        <label>Clasificación / Daño:</label><br>
                        <input type="text" name="tipo_dano" value="<?php if($registro != null) { echo $registro['tipo_dano']; } ?>" placeholder="Ej: Falta reductor vial" required>
                    </p>

                    <p>
                        <label>Dirección (Ubicación en Cali):</label><br>
                        <input type="text" name="direccion" value="<?php if($registro != null) { echo $registro['direccion']; } ?>" placeholder="Ej: Av. 1N # 4-50" required>
                    </p>

                    <p>
                        <label>Descripción:</label><br>
                        <textarea name="descripcion" rows="4" cols="30" required><?php if($registro != null) { echo $registro['descripcion']; } ?></textarea>
                    </p>

                    <p>
                        <label>Fotografía de Evidencia:</label><br>
                        <input type="file" name="imagen_url" accept="image/*" <?php if($registro == null) { echo "required"; } ?>>
                    </p>

                    <p>
                        <input type="submit" value="<?php if($registro != null) { echo "Guardar Cambios"; } else { echo "Enviar Solicitud"; } ?>">
                    </p>
                    
                    <?php if($registro != null) { ?>
                        <p><a href="index.php?c=SolicitudNR&a=index">Cancelar Edición</a></p>
                    <?php } ?>
                </form>

            </td>

            <td width="65%" valign="top" style="padding-left: 20px;">
                
                <h3>Listado de Solicitudes Existentes</h3>

                <table border="1" cellspacing="0" cellpadding="5" width="100%">
                    <tr bgcolor="#CCCCCC">
                        <th>Foto</th>
                        <th>Dirección</th>
                        <th>Daño</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    
                    <?php if (empty($solicitudes)) { ?>
                        <tr>
                            <td colspan="5" align="center">No hay solicitudes guardadas en la base de datos.</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($solicitudes as $row) { ?>
                            <tr>
                                <td align="center">
                                    <?php if ($row['imagen_url'] != "") { ?>
                                        <img src="web/uploads/reductores/<?php echo $row['imagen_url']; ?>" width="60" height="60">
                                    <?php } else { echo "Sin foto"; } ?>
                                </td>
                                <td><?php echo $row['direccion']; ?></td>
                                <td><?php echo $row['tipo_dano']; ?></td>
                                <td align="center">
                                    <?php 
                                        if($row['id_estado'] == 1) { 
                                            echo "<b>Pendiente</b>"; 
                                        } else { 
                                            echo "Procesado"; 
                                        } 
                                    ?>
                                </td>
                                <td align="center">
                                    <?php if ($row['id_estado'] == 1) { ?>
                                        <a href="index.php?c=SolicitudNR&a=editar&id=<?php echo $row['id_sol_nuevas_red']; ?>">Editar</a> | 
                                        <a href="index.php?c=SolicitudNR&a=eliminar&id=<?php echo $row['id_sol_nuevas_red']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Borrar</a>
                                    <?php } else { ?>
                                        <span>Solo lectura</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>