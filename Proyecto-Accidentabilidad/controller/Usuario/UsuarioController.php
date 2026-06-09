<?php
include_once '../model/Usuario/UsuarioModel.php';
class UsuarioController{

function getCreate(){
$obj      = new UsuarioModel();
$sql      = "SELECT * FROM tipo_documento";
$ejecutar = $obj->select($sql);

$tipo = [];
if ($ejecutar && pg_num_rows($ejecutar) > 0) {
    while ($fila = pg_fetch_assoc($ejecutar)) {
        $tipo[] = $fila; 
    }
}
include_once "../web/registro.php";
}

function postCreate(){
    $obj = new UsuarioModel();

    $id_tipo_doc = $_POST['tipo_documento'];
    $numero_doc = $_POST['numero_documento'];
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $numero_tel = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contra = $_POST['contrasena'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO usuarios (numero_id, nombre, apellido, contrasena, correo, telefono, direccion, id_tipo_doc, id_rol, id_estado) VALUES ($numero_doc, '$nombres', '$apellidos', '$contra', '$correo', '$numero_tel','$direccion', $id_tipo_doc, 1, 1)";
    $ejecutar = $obj->insert($sql);

    if($ejecutar){
        echo "<script>window.location.href='".redirect('../web/index.php')."&msg=ok';</script>";
        } else {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate", false, ajax)."&msg=error';</script>";
        }
    
}
}
?>