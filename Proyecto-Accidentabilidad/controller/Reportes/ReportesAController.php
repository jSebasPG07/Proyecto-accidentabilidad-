<?php

include_once "../model/Reportes/ReportesAModel.php";

class ReportesAController {

    public function getCreate(){
        $obj = new ReportesAModel();
        $sql = "SELECT * FROM tipo_choque";
        $reportes = $obj->select($sql);
        include_once "../view/Reportes/ReportesAView.php";
    }

    public function postCreate(){
        $obj = new ReportesAModel();

        $fechaaccidente = date("Y-m-d");
        $nomenclatura = $_POST['nomenclatura'];
        $nlesionados = $_POST['nlesionados'];
        $tchoque = $_POST['tchoque'];
        $direccion = $_POST['direccion'];
        $observaciones = $_POST['observaciones'];

        $id_estado = 3;

        $id_usuario = $_POST['id'];

    
        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;

        if(move_uploaded_file($archivo, $ruta)){

            $sql = "INSERT INTO reporte_accidente 
            (fecha_accidente, nomenclatura, num_lesionados, observaciones, imagen_url, direccion, id_estado, id_tipo_choque, id_usuario) 
            VALUES 
            ('$fechaaccidente', '$nomenclatura', '$nlesionados', '$observaciones', '$ruta', '$direccion', '$id_estado', '$tchoque','$id_usuario')";

            $ejecutar = $obj->insert($sql);

            if($ejecutar){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=ok';</script>";
            } else {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=error';</script>";
            }

        } else {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=imgerror';</script>";
            }
    }

    public function getUpdate(){
        $obj = new ReportesAModel();

        $id_reporte_acc = $_GET['id'];

        $sql = "SELECT a.id_reporte_acc, 
                       a.fecha_accidente, 
                       a.nomenclatura, 
                       a.num_lesionados, 
                       a.observaciones, 
                       a.direccion,
                       es.nombre AS estado,
                       a.imagen_url,
                       t.nombre AS tipo_choque
                FROM reporte_accidente a
                LEFT JOIN estado es ON a.id_estado = es.id_estado 
                LEFT JOIN tipo_choque t ON a.id_tipo_choque = t.id_tipo_choque
                WHERE a.id_reporte_acc = $id_reporte_acc";

        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
        $estados = $obj->select($sql);

        include_once "../view/Reportes/UpdateReporteA.php";
    }

    public function postUpdate(){

        $obj = new ReportesAModel();

        $id_reporte_acc = $_POST{'id_reporte_acc'};
        $id_estado = $_POST['id_estado'];

        $sql = "UPDATE reporte_accidente SET id_estado = $id_estado WHERE id_reporte_acc = $id_reporte_acc";

        $ejecutar = $obj->update($sql);

        if ($ejecutar) {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
        } else {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
        }


    }
}

?>