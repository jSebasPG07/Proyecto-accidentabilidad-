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
        $nlesionados = $_POST['nlesionados'];
        $tchoque = $_POST['tchoque'];
        $tipo_via = $_POST['tipo_via'];
        $numero1 = strtoupper($_POST['numero1']);
        $numero2 = $_POST['numero2'];
        $numero3 = $_POST['numero3'];
        $direccion = "$tipo_via $numero1 # $numero2 - $numero3";
        $observaciones = $_POST['observaciones'];

        $id_estado = 3;

        $id_usuario = $_POST['id'];
        $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
        $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);

        //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
        //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
        //Tambien por que puede tener una letra al final
        if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero1)){
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=numero1_formato';</script>";
            exit();

            
        }

        //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
        //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
        //Tambien por que puede tener una letra al final
        if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero2)){
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=numero2_formato';</script>";
            exit();
        }

        //Esta validacion permite 3 numeros pero no letra al final
        if(!preg_match('/^[0-9]{1,3}$/', $numero3)){
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=numero3_formato';</script>";
            exit();
        }

        
        //Este campo no puede tener mas de 200 caracteres
        //el strlen cuenta la cantidad de caracteres que hay 
        if (strlen($observaciones) > 200) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_largo';</script>"; 
            exit();
        }

        //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
        //Esta bloquea los caracteres especiales @$,#,%,!
        if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $observaciones)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_formato';</script>";
            exit();   
        }

        //verifica que solo sean letras
        if (!preg_match('/^[A-Za-z\s]+$/', $observaciones)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_letra';</script>";
            exit();
        }
        //Verifica que tenaga almenos 2 palabras y el espacio osea digams choque frontal osea asi con el espacio 
        if (!preg_match('/^\s*\S+\s+\S+.*$/', $observaciones)) {
             echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_palabras';</script>";
             exit();
        }

    
        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;

        //Esta linea verifica si se subio un archivo 
        if (!empty($img)) {

            //Esto va obtener la extension del archivo osea ps si es jpg o png 
            $extension = strtolower(pathinfo($img, PATHINFO_EXTENSION)); //saca la extension del archivo osea si el archivoes foto.PNG entonces solo saca el PNG 
            //Y el strtolower Lo convierte en minuscula esta extension que saca


            //Aqui ps si no es ni png, jepg o jpg lo manda al error 
            if ($extension != "jpg" && $extension != "jpeg" && $extension != "png") {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=tipoimg';</script>";
                exit();
            }
        }

        if(move_uploaded_file($archivo, $ruta)){

            $sql = "INSERT INTO reporte_accidente 
            (fecha_accidente, num_lesionados, observaciones, imagen_url, direccion, id_estado, id_tipo_choque, id_usuario, coordenadas) 
            VALUES 
            ('$fechaaccidente', '$nlesionados', '$observaciones', '$ruta', '$direccion', '$id_estado', '$tchoque','$id_usuario', ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

            $ejecutar = $obj->insert($sql);
            $ejecutar = $obj->insert($sql);

            

        } else {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=imgerror';</script>";
            }
    }

    public function getUpdate(){
        $obj = new ReportesAModel();

        $id_reporte_acc = $_GET['id'];

        $sql = "SELECT a.id_reporte_acc, 
                       a.fecha_accidente,  
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

        $id_reporte_acc = $_POST['id_reporte_acc'];
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