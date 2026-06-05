<?php 

include_once "../model/Reportes/SolicitudVMEModel.php";

class SolicitudVMEController {

    public function getCreate(){
        $obj = new SolicitudVMEModel();
        $sql = "SELECT * FROM tipo_dano_via";
        $tiposDanoVia = $obj->select($sql);
        include_once "../view/Reportes/SolicitudVMEView.php";
    }

    public function postCreate(){
        $obj = new SolicitudVMEModel();

        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idtipodanovia = $_POST['idtipodanovia'];

        $id_estado = 3;

        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img" . $img;

        if (move_uploaded_file($archivo, $ruta)) {
            
            $sql = "INSERT INTO sol_via_mal_estado (descripcion, imagen_url, direccion, id_estado, id_tipo_dano_via) 
                    VALUES ('$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipodanovia')";

            $ejecutar = $obj->insert($sql);

            if($ejecutar) {
                echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=ok';</script>";
            } else {
                echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=error';</script>";
            }
        } else {
            echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=imgerror';</script>";
        }

    }
    
}


?>