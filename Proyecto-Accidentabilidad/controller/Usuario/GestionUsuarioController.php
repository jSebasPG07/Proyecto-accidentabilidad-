<?php

include_once "../model/Usuario/GestionUsuariosModel.php";

class GestionUsuarioController{

    public function index(){
        $this->getList();
    }

    public function getList(){

        $obj = new GestionUsuariosModel();

        $sql = "SELECT
                    u.id,
                    u.numero_id,
                    u.nombre,
                    u.apellido,
                    u.correo,
                    r.nombre_rol,
                    e.nombre AS estado
                FROM usuarios u
                INNER JOIN roles r
                    ON u.id_rol = r.id_rol
                INNER JOIN estado e
                    ON u.id_estado = e.id_estado";

        $usuarios = $obj->select($sql);

        include_once "../view/Usuario/GestionUsuarioView.php";
    }

    public function getView(){

        $obj = new GestionUsuariosModel();

        $id = $_GET['id'];

        $sql = "SELECT
                    u.*,
                    r.nombre_rol,
                    e.nombre AS estado
                FROM usuarios u
                INNER JOIN roles r
                    ON u.id_rol = r.id_rol
                INNER JOIN estado e
                    ON u.id_estado = e.id_estado
                WHERE u.id = '$id'";

        $usuario = $obj->select($sql);

        include_once "../view/Usuario/ViewUsuario.php";
    }

    public function getEdit(){

        $obj = new GestionUsuariosModel();

        $id = $_GET['id'];

        $sqlUsuario = "SELECT * FROM usuarios WHERE id = '$id'";
        $usuario = $obj->select($sqlUsuario);

        $sqlRoles = "SELECT * FROM roles";
        $roles = $obj->select($sqlRoles);

        $sqlEstados = "SELECT * FROM estado WHERE controlador = 'usuario'";
        $estados = $obj->select($sqlEstados);

        include_once "../view/Usuario/EditUsuario.php";
    }

    public function postUpdate(){

        $obj = new GestionUsuariosModel();

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $idRol = $_POST['id_rol'];
        $idEstado = $_POST['id_estado'];

        $sql = "UPDATE usuarios
                SET
                    nombre='$nombre',
                    apellido='$apellido',
                    correo='$correo',
                    id_rol='$idRol',
                    id_estado='$idEstado'
                WHERE id='$id'";

        $ejecutar = $obj->update($sql);

        if($ejecutar){

            echo "<script>
                    window.location.href='".getUrl("Usuario","GestionUsuario","getList")."';
                  </script>";

        }
    }
}
?>