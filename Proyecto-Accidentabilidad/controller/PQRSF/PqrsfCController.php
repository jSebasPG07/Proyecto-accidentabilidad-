<?php

include_once "../model/PQRSF/PqrsfModel.php";

Class PqrsfCController {

    public function getCreate(){
        $obj = new PqrsfModel();
        $sql = "SELECT * FROM tipo_pqrsf";
        $tpqrsff = $obj->select($sql);
        include_once "../view/PQRSF/PqrsfCCreate.php";
    }

    public function postCreate(){
        $obj = new PqrsfModel();

        $fechapqrsf = date("Y-m-d");
        $mensaje = $_POST['mensaje'];
        $tpqrsf = $_POST['tpqrsf'];
        $mensaje = $_POST['mensaje'];
        $id_estado = 3;

        $id_usuario = $_POST['id'];

        $sql = "INSERT INTO pqrsf (fecha_pqrsf, mensaje, id_estado, id_tipo_pqrsf, id_usuario) VALUES ('$fechapqrsf','$mensaje','$id_estado','$tpqrsf','$id_usuario')";

        $ejecutar = $obj->insert($sql);
        
        

        if($ejecutar){
                echo "<script>window.location.href='".getUrl("PQRSF","PqrsfC","getCreate")."&msg=ok';</script>";
        } else {
                echo "<script>window.location.href='".getUrl("PQRSF","PqrsfC","getCreate")."&msg=error';</script>";
        }

    } 

    public function getList(){

        $obj = new PqrsfModel();

        $sql = "SELECT p.id_pqrsf,
                       p.fecha_pqrsf,
                       p.mensaje,
                       p.respuesta,
                       p.fecha_respuesta,
                       e.nombre AS estado,
                       t.nombre AS tipo_pqrsf,
                       u.numero_id AS usuarios
                FROM  Pqrsf p
                LEFT JOIN estado e ON p.id_estado = e.id_estado
                LEFT JOIN tipo_pqrsf t ON p.id_tipo_pqrsf = t.id_tipo_pqrsf
                LEFT JOIN usuarios u ON p.id_usuario = u.id
                ORDER BY p.id_pqrsf ASC";
        $pqrsf = $obj->select($sql);

        include_once "../view/PQRSF/TablaPqrsf.php";


    }

    public function getUpdate(){

        $obj = new PqrsfModel();

        $id_pqrsf = $_GET['id'];

        $sql = "SELECT p.id_pqrsf,
                   p.fecha_pqrsf,
                   p.mensaje,
                   p.respuesta,
                   p.fecha_respuesta,
                   e.nombre AS estado,
                   t.nombre AS tipo_pqrsf,
                   u.numero_id AS usuario
            FROM pqrsf p
            LEFT JOIN estado e ON p.id_estado = e.id_estado
            LEFT JOIN tipo_pqrsf t ON p.id_tipo_pqrsf = t.id_tipo_pqrsf
            LEFT JOIN usuarios u ON p.id_usuario = u.id
            WHERE p.id_pqrsf = $id_pqrsf";
        
        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes'";
        $estados = $obj->select($sql);

        include_once "../view/PQRSF/UpdatePqrsf.php";
    } 

    public function postUpdate(){

    $obj = new PqrsfModel();

    $id_pqrsf = $_POST['id_pqrsf'];
    $respuesta = $_POST['respuesta'];
    $id_estado = $_POST['id_estado'];

    $fecha_respuesta = date("Y-m-d");

    $sql = "UPDATE pqrsf 
            SET respuesta = '$respuesta',
                fecha_respuesta = '$fecha_respuesta',
                id_estado = '$id_estado'
            WHERE id_pqrsf = $id_pqrsf";

    $ejecutar = $obj->update($sql);

    if($ejecutar){
        echo "<script>window.location.href='".getUrl("PQRSF","PqrsfC","getList")."';</script>";
    } else {
        echo "Error al actualizar";
    }
}
    
}

?>