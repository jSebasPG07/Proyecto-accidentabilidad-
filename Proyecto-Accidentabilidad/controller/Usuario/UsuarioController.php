<?php
include_once "../model/Usuario/UsuarioModel.php";
class UsuarioController
{
    public function getCreate()
    {
        $obj = new UsuarioModel();
        $sql = "SELECT * FROM tipo_documento";
        $ejecutar = $obj->select($sql);
        if (pg_num_rows($ejecutar) > 0) {
            $tipo = pg_fetch_assoc($ejecutar);
        }
        
        include_once "../web/registro.php";
    }
}
?>