<?php

include_once "../model/Reportes/ReportesRMEModel.php";

class ReportesRMEController {

    public function getCreate() {
        $obj = new ReportesRMEModel();

        $sql = "SELECT tr.id_tipo_reductor, tr.nombre, cr.nombre AS categoria 
                FROM tipo_reductor tr 
                JOIN categoria_reductor cr ON tr.id_cat_reductor = cr.id_cat_reductor";
        $tiposReductor = $obj->select($sql);

        $sql2 = "SELECT * FROM tipo_dano_reductor";
        $tiposDanoReductor = $obj->select($sql2);

        include_once "../view/Reportes/ReportesRMEView.php";
    }

    public function postCreate() {
        $obj = new ReportesRMEModel();

        $fecharme = date("d-m-y");
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idtipored = $_POST['idtipored'];
        $idtipodanoreductor = $_POST['idtipodanoreductor'];
        $id_usuario = $_POST['id'];

        $id_estado = 3;

        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;


            if (move_uploaded_file($archivo, $ruta)) {

                $sql = "INSERT INTO sol_reductor_mal_estado 
                            (fecha_reductor_mal_estado, descripcion, imagen_url, direccion, id_estado, id_tipo_reductor, id_tipo_dano_reductor, id_usuario) 
                        VALUES 
                            ('$fecharme','$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipored', '$idtipodanoreductor', '$id_usuario')";

                $ejecutar = $obj->insert($sql);

                if ($ejecutar) {
                    echo "<script>window.location.href='" . getUrl("Reportes", "ReportesRME", "getCreate") . "&msg=ok';</script>";
                } else {
                    echo "<script>window.location.href='" . getUrl("Reportes", "ReportesRME", "getCreate") . "&msg=error';</script>";
                }

            } else {
                echo "<script>window.location.href='" . getUrl("Reportes", "ReportesRME", "getCreate") . "&msg=imgerror';</script>";
            }

    }

    public function getUpdate(){

        $obj = new ReportesRMEModel();

        $id_sol_red_mal = $_GET['id'];

        $sql = "SELECT rm.id_sol_red_mal, 
                    rm.fecha_reductor_mal_estado,
                    rm.descripcion,
                    rm.imagen_url, 
                    rm.direccion, 
                    es.nombre AS estado, 
                    tr.nombre AS tipo_reductor,
                    tdr.descripcion AS tipo_dano,  
                    u.numero_id AS usuario
                FROM sol_reductor_mal_estado rm 
                LEFT JOIN estado es ON rm.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rm.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rm.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rm.id_usuario = u.id
                WHERE rm.id_sol_red_mal = $id_sol_red_mal";

        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
        $estados = $obj->select($sql);

        include_once "../view/Reportes/UpdateReporteRME.php";
    }
    
    public function postUpdate(){

        $obj = new ReportesRMEModel();

        $id_sol_red_mal = $_POST{'id_sol_red_mal'};
        $id_estado = $_POST['id_estado'];

        $sql = "UPDATE sol_reductor_mal_estado SET id_estado = $id_estado WHERE id_sol_red_mal = $id_sol_red_mal";

        $ejecutar = $obj->update($sql);

        if ($ejecutar) {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
        } else {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
        }


    }
}



?>