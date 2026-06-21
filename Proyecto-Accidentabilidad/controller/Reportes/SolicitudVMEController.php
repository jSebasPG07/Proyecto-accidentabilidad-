<?php

include_once "../model/Reportes/SolicitudVMEModel.php";

class SolicitudVMEController {

    public function getCreate() {
        $obj = new SolicitudVMEModel();

        $sql = "SELECT * FROM tipo_dano_via";
        $tiposDanoVia = $obj->select($sql);

        include_once "../view/Reportes/SolicitudVMEView.php";
    }

    public function postCreate() {
        $obj = new SolicitudVMEModel();
        $fechavme = date("d-m-y");
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idtipodanovia = $_POST['idtipodanovia'];
        $id_usuario = $_POST['id'];

        $id_estado = 3;

        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;


            if (move_uploaded_file($archivo, $ruta)) {

                $sql = "INSERT INTO sol_via_mal_estado 
                            (fecha_via_mal_estado, descripcion, imagen_url, direccion, id_estado, id_tipo_dano_via, id_usuario) 
                        VALUES 
                            ('$fechavme','$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipodanovia', '$id_usuario')";

                $ejecutar = $obj->insert($sql);

                if ($ejecutar) {
                    echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=ok';</script>";
                } else {
                    echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=error';</script>";
                }

            } else {
                echo "<script>window.location.href='" . getUrl("Reportes", "SolicitudVME", "getCreate") . "&msg=imgerror';</script>";
            }

    }
    public function getUpdate(){
        $obj = new SolicitudVMEModel();

        $id_sol_via_mal = $_GET['id'];

        $sql = "SELECT vm.id_sol_via_mal,
                       vm.fecha_via_mal_estado,
                       vm.descripcion,
                       vm.imagen_url, 
                       vm.direccion, 
                       es.nombre AS estado, 
                       tdv.id_tipo_dano_via AS tipo_dano_via,  
                       u.numero_id AS usuario
                FROM sol_via_mal_estado vm 
                LEFT JOIN estado es ON vm.id_estado = es.id_estado 
                LEFT JOIN tipo_dano_via tdv ON vm.id_tipo_dano_via = tdv.id_tipo_dano_via  
                LEFT JOIN usuarios u ON vm.id_usuario = u.id
                WHERE vm.id_sol_via_mal = $id_sol_via_mal";

        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
        $estados = $obj->select($sql);

        include_once "../view/Reportes/UpdateSolicitudVME.php";
    }

    public function postUpdate(){

        $obj = new SolicitudVMEModel();

        $id_sol_via_mal = $_POST{'id_sol_via_mal'};
        $id_estado = $_POST['id_estado'];

        $sql = "UPDATE sol_via_mal_estado SET id_estado = $id_estado WHERE id_sol_via_mal = $id_sol_via_mal";

        $ejecutar = $obj->update($sql);

        if ($ejecutar) {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
        } else {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
        }
    }

}



?>