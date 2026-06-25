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
        $tipo_via = $_POST['tipo_via'];
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $complemento = $_POST['complemento'];
        $descripcion = $_POST['descripcion'];
        $direccion = "$tipo_via $numero1 # $numero2 $complemento";
        $idtipodanovia = $_POST['idtipodanovia'];
        $id_usuario = $_POST['id'];

        $id_estado = 3;

        $coordX = floatval($_POST['coord_x'] ?? 0);
        $coordY = floatval($_POST['coord_y'] ?? 0);
        


            //Esta validacion es por que el numero debe ser asi primero numero despues una letra opcional
            // no va permitir letra primero tampoco si se pone un numero espacio y despues la letra 
            if (!preg_match('/^[0-9]+[A-Za-z]?$/', $numero1)) {
                echo "<script>window.location.href='".getUrl("Reportes","SolicitudVME","getCreate")."&msg=numero1';</script>";
            }

            //Esta validacion puede ser un numero o un numero con el guion
            //No va permitir un guion y desoues el numero osea asi (-30)
            if (!preg_match('/^[0-9]+[A-Za-z]?(-[0-9]+)?$/', $numero2)) {
                echo "<script>window.location.href='".getUrl("Reportes","SolicitudVME","getCreate")."&msg=numero2';</script>"; 
            }

        
            //Este campo no puede tener mas de 200 caracteres
            if (strlen($descripcion) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","SolicitudVME","getCreate")."&msg=desc_largo';</script>"; 
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","SolicitudVME","getCreate")."&msg=desc_formato';</script>";   
            }

            //verifica que tenga al menos una letra osea que si ponen 8888 muestra el error
            if (!preg_match('/[A-Za-z]/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","SolicitudVME","getCreate")."&msg=desc_letra';</script>";
            }

            $img = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../img/" . $img;

            if (!empty($img)) {

            //Esto va obtener la extension del archivo osea ps si es jpg o png 
            $extension = strtolower(pathinfo($img, PATHINFO_EXTENSION)); //saca la extension del archivo osea si el archivoes foto.PNG entonces solo saca el PNG 
            //Y el strtolower Lo convierte en minuscula esta extension que saca


            //Aqui ps si no es ni png, jepg o jpg lo manda al error 
                if ($extension != "jpg" && $extension != "jpeg" && $extension != "png") {
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=tipoimg';</script>";
                }
            }


            if (move_uploaded_file($archivo, $ruta)) {

                $sql = "INSERT INTO sol_via_mal_estado 
                            (fecha_via_mal_estado, descripcion, imagen_url, direccion, id_estado, id_tipo_dano_via, id_usuario) 
                        VALUES 
                            ('$fechavme','$descripcion', '$ruta', '$direccion', '$id_estado', '$idtipodanovia', '$id_usuario', ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

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

        $id_sol_via_mal = $_POST['id_sol_via_mal'];
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