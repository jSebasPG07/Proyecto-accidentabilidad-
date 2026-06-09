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

        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idtipored = $_POST['idtipored'];
        $idtipodanoreductor = $_POST['idtipodanoreductor'];
        $id_usuario = $_SESSION['id'];

        $id_estado = 3;

        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;


            if (move_uploaded_file($archivo, $ruta)) {

                $sql = "INSERT INTO sol_reductor_mal_estado 
                            (descripcion, imagen_url, direccion, id_estado, id_tipo_reductor, id_tipo_dano_reductor, id_usuario) 
                        VALUES 
                            ('$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipored', '$idtipodanoreductor', '$id_usuario')";

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
    
}



?>