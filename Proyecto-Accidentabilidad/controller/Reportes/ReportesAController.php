<?php

include_once "../model/Reportes/ReportesAModel.php";
class ReportesAController {

    public function test(){
        $obj = new ReportesAModel();
    }
    
    public function getCreate(){
        $obj = new ReportesAModel();
        $sql = "SELECT * FROM tipo_choque";
        $reportes = $obj->select($sql);
        include_once "../view/Reportes/ReportesAView.php";
    }

    public function postCreate(){
        $obj = new ReportesAModel();

        $fechaaccidente = $_POST['fechaaccidente'];
        $nomenclatura = $_POST['nomenclatura'];
        $nlesionados = $_POST['nlesionados'];
        $tchoque = $_POST['tchoque'];
        $taccidente = $_POST['taccidente'];
        $cvehiculo = $_POST['cvehiculo'];
        $direccion = $_POST['direccion'];
        $observacion = $_POST['observacion'];

        $sql = "INSERT INTO reportes_accidentes (fecha_accidente, nomenclatura, numero_lesionados, tipo_choque, tipo_accidente, cantidad_vehiculos, direccion, observacion) VALUES ('$fechaaccidente', '$nomenclatura', '$nlesionados', '$tchoque', '$taccidente', '$cvehiculo', '$direccion', '$observacion')";
        $obj->insert($sql);
    }



}








?>