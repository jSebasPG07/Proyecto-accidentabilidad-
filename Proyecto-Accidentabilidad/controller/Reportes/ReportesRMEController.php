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
        $tipo_via = $_POST['tipo_via'];
        $numero1 = strtoupper($_POST['numero1']);
        $numero2 = $_POST['numero2'];
        $numero3 = $_POST['numero3'];
        $referencia = $_POST['referencia'];
        $direccion = "$tipo_via $numero1 # $numero2 - $numero3";
        $idtipored = $_POST['idtipored'];
        $idtipodanoreductor = $_POST['idtipodanoreductor'];
        $id_usuario = $_POST['id'];

        $id_estado = 3;
        $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
        $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);
            
            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero1)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=numero1_formato';</script>";
                exit();
            
            }

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero2)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=numero2_formato';</script>";
                exit();
            }

            //Esta validacion permite 3 numeros pero no letra al final
            if(!preg_match('/^[0-9]{1,3}$/', $numero3)){
            echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=numero3_formato';</script>";
            exit();
            }

        
            //Este campo no puede tener mas de 200 caracteres
            //el strlen cuenta la cantidad de caracteres que hay 
            if (strlen($descripcion) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=desc_largo';</script>"; 
                exit();
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=desc_formato';</script>";  
                exit(); 
            }

            //verifica que solo sean letras
            if (!preg_match('/^[A-Za-z\s]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=desc_letra';</script>";
                exit();
            }
            
            if (!preg_match('/^\s*\S+\s+\S+.*$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=desc_palabras';</script>";
                exit();
            }

            //Este campo no puede tener mas de 200 caracteres
            //el strlen cuenta la cantidad de caracteres que hay 
            if (strlen($referencia) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=ref_largo';</script>"; 
                exit();
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=ref_formato';</script>"; 
                exit();  
            }

            //verifica que solo sean letras
            if (!preg_match('/^[A-Za-z\s]+$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=ref_letra';</script>";
                exit();
            }
            
            if (!preg_match('/^\s*\S+\s+\S+.*$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=ref_palabras';</script>";
                exit();
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
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesRME","getCreate")."&msg=tipoimg';</script>";
                    exit();
                }
            }


            if (move_uploaded_file($archivo, $ruta)) {

                $sql = "INSERT INTO sol_reductor_mal_estado 
                            (fecha_reductor_mal_estado, descripcion, imagen_url, direccion, referencia, id_estado, id_tipo_reductor, id_tipo_dano_reductor, id_usuario, coordenadas) 
                        VALUES 
                            ('$fecharme','$descripcion', '$ruta', '$direccion', '$referencia','$id_estado','$idtipored', '$idtipodanoreductor', '$id_usuario', ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

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
                    rm.referencia,
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

        $id_sol_red_mal = $_POST['id_sol_red_mal'];
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