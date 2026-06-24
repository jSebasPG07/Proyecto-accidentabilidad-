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
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $complemento = $_POST['complemento'];
        $direccion = "$tipo_via $numero1 # $numero2 $complemento";
        $observaciones = $_POST['observaciones'];

        $id_estado = 3;

        $id_usuario = $_POST['id'];

        //Esta validacion es por que el numero debe ser asi primero numero despues una letra opcional
        // no va permitir letra primero tampoco si se pone un numero espacio y despues la letra 
        if (!preg_match('/^[0-9]+[A-Za-z]?$/', $numero1)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=numero1';</script>";
        }

        //Esta validacion puede ser un numero o un numero con el guion
        //No va permitir un guion y desoues el numero osea asi (-30)
        if (!preg_match('/^[0-9]+[A-Za-z]?(-[0-9]+)?$/', $numero2)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=numero2';</script>"; 
        }

        
        //Este campo no puede tener mas de 200 caracteres
        if (strlen($observaciones) > 200) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_largo';</script>"; 
        }

        //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
        //Esta bloquea los caracteres especiales @$,#,%,!
        if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $observaciones)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_formato';</script>";   
        }

        //verifica que tenga al menos una letra osea que si ponen 8888 muestra el error
        if (!preg_match('/[A-Za-z]/', $observaciones)) {
            echo "<script>window.location.href='".getUrl("Reportes","ReportesA","getCreate")."&msg=obs_letra';</script>";
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
            }
        }

        if(move_uploaded_file($archivo, $ruta)){

            $sql = "INSERT INTO reporte_accidente 
            (fecha_accidente, num_lesionados, observaciones, imagen_url, direccion, id_estado, id_tipo_choque, id_usuario) 
            VALUES 
            ('$fechaaccidente', '$nlesionados', '$observaciones', '$ruta', '$direccion', '$id_estado', '$tchoque','$id_usuario')";

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