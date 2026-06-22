<?php
include_once '../model/Usuario/UsuarioModel.php';
class UsuarioController{

function getCreate(){
$obj      = new UsuarioModel();
$sql      = "SELECT * FROM tipo_documento";
$ejecutar = $obj->select($sql);

$tipo = array();
if ($ejecutar && pg_num_rows($ejecutar) > 0) {
    while ($fila = pg_fetch_assoc($ejecutar)) {
        $tipo[] = $fila; 
    }
}
include_once "../web/registro.php";
}

    public function postCreate()
    {
        $obj = new UsuarioModel();
        $tipo_documento = $_POST['tipo_documento'];
        $numero_documento = $_POST['numero_documento'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $direccion = $_POST['direccion'];

        $id = $obj -> autoincrement(usuarios, id);
    
        $sql = "INSERT INTO usuarios (id, id_tipo_doc, numero_id, nombre, apellido, telefono, correo, contrasena, direccion, id_rol, id_estado ) VALUES ('$id', '$tipo_documento', '$numero_documento', '$nombre', '$apellido', '$telefono', '$correo', '$contrasena', '$direccion', 1, 1)";
        $ejecutar = $obj->insert($sql);
        if ($ejecutar) {
            redirect("login.php");
        }   else {
            echo "Error al registrar el usuario.";
        }
    }
}



?>