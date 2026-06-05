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

        $fechaaccidente = $_POST['fechaaccidente'];
        $nomenclatura = $_POST['nomenclatura'];
        $nlesionados = $_POST['nlesionados'];
        $tchoque = $_POST['tchoque'];
        $direccion = $_POST['direccion'];
        $observaciones = $_POST['observaciones'];

        $id_estado = 3;

    
        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;

        if(move_uploaded_file($archivo, $ruta)){

            $sql = "INSERT INTO reporte_accidente 
            (fecha_accidente, nomenclatura, num_lesionados, observaciones, imagen_url, direccion, id_estado, id_tipo_choque) 
            VALUES 
            ('$fechaaccidente', '$nomenclatura', '$nlesionados', '$observaciones', '$ruta', '$direccion', '$id_estado', '$tchoque')";

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
}

?>