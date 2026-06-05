<?php 

include_once "../model/Reportes/ReportesRMEModel.php";

class ReportesRMEController {

    public function getCreate() {
        $obj = new ReportesRMEModel();
        $sql = "SELECT * FROM tipo_reductor";
        $tiposReductor = $obj->select($sql);
        include_once "../view/Reportes/ReportesRMEView.php";
    }

    public function postCreate() {
        $obj = new ReportesRMEModel();

        $tipodano    = $_POST['tipodano'];
        $descripcion = $_POST['descripcion'];
        $direccion   = $_POST['direccion'];
        $idtipored   = $_POST['idtipored'];

        $id_estado = 3;

        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;

        if (move_uploaded_file($archivo, $ruta)) {

            $sql = "INSERT INTO sol_reductor_mal_estado (tipo_dano, descripcion, imagen_url, direccion, id_estado, id_tipo_reductor) 
                    VALUES ('$tipodano', '$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipored')";

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