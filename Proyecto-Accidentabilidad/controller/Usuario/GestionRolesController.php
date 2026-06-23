<?php

include_once "../model/Usuario/GestionRolesModel.php";

class GestionRolesController{

    public function getList(){

        $obj = new GestionRolesModel();

        $sql = "SELECT * FROM roles";
        $roles = $obj->select($sql);

        include_once "../view/Usuario/GestionRolesView.php";
    }

    // Muestra el formulario para crear un rol nuevo, con todos los permisos disponibles
    public function getCreate(){

        $obj = new GestionRolesModel();

        $sqlModulos = "SELECT
                            m.id_modulo,
                            m.nombre AS nombre_modulo,
                            p.id_permiso,
                            p.nombre AS nombre_permiso,
                            a.id_accion,
                            a.nombre AS nombre_accion
                        FROM modulos m
                        INNER JOIN permisos p ON p.id_modulo = m.id_modulo
                        INNER JOIN acciones a ON a.id_accion = p.accion
                        WHERE m.activo = true
                        AND p.activo = true
                        ORDER BY m.id_modulo, a.id_accion";

        $modulosPermisos = $obj->select($sqlModulos);

        include_once "../view/Usuario/CreateRoles.php";
    }

    // Guarda el rol nuevo y le asigna los permisos marcados
    public function postCreate(){

        $obj = new GestionRolesModel();

        $nombre_rol = $_POST['nombre_rol'];

        $permisosMarcados = isset($_POST['permisos']) ? $_POST['permisos'] : array();

        $id_rol = $obj -> autoincrement(roles, id_rol);
        $sqlInsertRol = "INSERT INTO roles (id_rol, nombre_rol) VALUES ('$id_rol', '$nombre_rol')";
        $ejecutar = $obj->insert($sqlInsertRol);

        if($ejecutar){

            foreach($permisosMarcados as $id_permiso){
                $id_rol_permiso = $obj -> autoincrement(rol_permiso, id_rol_permiso);
                $sqlInsertPermiso = "INSERT INTO rol_permiso (id_rol_permiso, id_rol, id_permiso) VALUES ('$id_rol_permiso', '$id_rol', '$id_permiso')";
                $obj->insert($sqlInsertPermiso);
            }

            redirect(getUrl("Usuario","GestionRoles","getList"));

        } else {
            echo "Error al crear el rol.";
        }
    }

    public function getEdit(){

        $obj = new GestionRolesModel();

        $id_rol = $_GET['id'];

        $sqlRol = "SELECT * FROM roles WHERE id_rol = '$id_rol'";
        $rolResult = $obj->select($sqlRol);
        $rol = pg_fetch_assoc($rolResult);

        $sqlModulos = "SELECT
                            m.id_modulo,
                            m.nombre AS nombre_modulo,
                            p.id_permiso,
                            p.nombre AS nombre_permiso,
                            a.id_accion,
                            a.nombre AS nombre_accion
                        FROM modulos m
                        INNER JOIN permisos p ON p.id_modulo = m.id_modulo
                        INNER JOIN acciones a ON a.id_accion = p.accion
                        WHERE m.activo = true
                        AND p.activo = true
                        ORDER BY m.id_modulo, a.id_accion";

        $modulosPermisos = $obj->select($sqlModulos);

        $sqlAsignados = "SELECT id_permiso FROM rol_permiso WHERE id_rol = '$id_rol'";
        $resultAsignados = $obj->select($sqlAsignados);

        $permisosAsignados = array();
        while($fila = pg_fetch_assoc($resultAsignados)){
            $permisosAsignados[] = $fila['id_permiso'];
        }

        include_once "../view/Usuario/EditRoles.php";
    }

    public function postUpdate(){

        $obj = new GestionRolesModel();

        $id_rol = $_POST['id_rol'];

        $permisosMarcados = isset($_POST['permisos']) ? $_POST['permisos'] : array();

        $sqlAsignados = "SELECT id_permiso FROM rol_permiso WHERE id_rol = '$id_rol'";
        $resultAsignados = $obj->select($sqlAsignados);

        $permisosActuales = array();
        while($fila = pg_fetch_assoc($resultAsignados)){
            $permisosActuales[] = $fila['id_permiso'];
        }

        // Asignar los permisos marcados que todavia no tenia
        foreach($permisosMarcados as $id_permiso){
            if(!in_array($id_permiso, $permisosActuales)){
                $id_rol_permiso = $obj -> autoincrement(rol_permiso, id_rol_permiso);
                $sqlInsert = "INSERT INTO rol_permiso (id_rol_permiso, id_rol, id_permiso) VALUES ('$id_rol_permiso', '$id_rol', '$id_permiso')";
                $obj->insert($sqlInsert);
            }
        }

        // Quitar los permisos que tenia pero ya no estan marcados
        foreach($permisosActuales as $id_permiso){
            if(!in_array($id_permiso, $permisosMarcados)){
                $sqlDelete = "DELETE FROM rol_permiso WHERE id_rol = '$id_rol' AND id_permiso = '$id_permiso'";
                $obj->delete($sqlDelete);
            }
        }

        redirect(getUrl("Usuario","GestionRoles","getList"));
    }
}
?>
