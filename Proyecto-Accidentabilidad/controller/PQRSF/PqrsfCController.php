<?php

include_once "../model/PQRSF/PqrsfModel.php";

Class PqrsfCController {

    public function getCreate(){
        $obj = new PqrsfModel();
        $sql = "SELECT * FROM tipo_pqrsf";
        $tpqrsf = $obj->select($sql);
        include_once "../view/PQRSF/PqrsfCCreate.php";
    }

    public function postCreate(){
        $obj = new PqrsfModel();
        $id_tipo_pqrsf = $_POST['tpqrsf'];
        $mensaje = $_POST['descripcion'];
        $id_estado = 3;

        $id_usuario = $_POST['id'];

        $sql = "INSERT INTO pqrsf (mensaje, id_estado, id_tipo_pqrsf, id_usuario)VALUES ('$mensaje','$id_estado','$tpqrsf','$id_usuario')";

        $ejecutar = $obj->insert($sql);
        
        

        if($ejecutar){
                echo "<script>window.location.href='".getUrl("PQRSF","PqrsfC","getCreate")."&msg=ok';</script>";
        } else {
                echo "<script>window.location.href='".getUrl("PQRSF","PqrsfC","getCreate")."&msg=error';</script>";
        }

    } 
    
}

?>