<?php

include_once "../model/Reportes/ReportesSolicitudNRModel.php";

class ReportesSolicitudNRController {

        public function index(){
            $this->getCreate();
        }

        public function getCreate(){

            $obj = new ReportesSolicitudNRModel();

            $sqlReductor = "SELECT * FROM tipo_reductor";
            $reductores = $obj->select($sqlReductor);

            $sqlDano = "SELECT * FROM tipo_dano_reductor";
            $danos = $obj->select($sqlDano);

            include_once "../view/Reportes/ReportesSolicitudNR.php";
        }

        public function postCreate(){

            $obj = new ReportesSolicitudNRModel();

            $fechanreductor = date("d-m-y");
            $tipo_via = $_POST['tipo_via'];
            $descripcion = $_POST['descripcion'];
            $numero1 = strtoupper($_POST['numero1']); 
            $numero2 = $_POST['numero2'];
            $numero3 = $_POST['numero3'];
            $referencia = $_POST['referencia'];
            $direccion = "$tipo_via $numero1 # $numero2 - $numero3";
            $idTipoReductor = $_POST['id_tipo_reductor'];
            $idTipoDanoReductor = $_POST['id_tipo_dano_reductor'];


            $idEstado = 3;
            $id_usuario = $_POST['id'];
            $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
            $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero1)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero1_formato';</script>";
            
            }

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero2)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero2_formato';</script>";
            }

            //Esta validacion permite 3 numeros pero no letra al final
            if(!preg_match('/^[0-9]{1,3}$/', $numero3)){
            echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero3_formato';</script>";
            }

        
            //Este campo no puede tener mas de 200 caracteres
            //el strlen cuenta la cantidad de caracteres que hay 
            if (strlen($descripcion) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_largo';</script>"; 
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_formato';</script>";   
            }

            //verifica que solo sean letras
            if (!preg_match('/^[A-Za-z\s]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_letra';</script>";
            }
            
            if (!preg_match('/^\s*\S+\s+\S+.*$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_palabras';</script>";
            }

            //Este campo no puede tener mas de 200 caracteres
            //el strlen cuenta la cantidad de caracteres que hay 
            if (strlen($referencia) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ref_largo';</script>"; 
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ref_formato';</script>";   
            }

            //verifica que solo sean letras
            if (!preg_match('/^[A-Za-z\s]+$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ref_letra';</script>";
            }
            
            if (!preg_match('/^\s*\S+\s+\S+.*$/', $referencia)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ref_palabras';</script>";
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
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=tipoimg';</script>";
                }
            }



            if(move_uploaded_file($archivo, $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor(
                fecha_nuevo_reductor,descripcion,referencia,imagen_url,direccion,id_estado,id_tipo_reductor,id_tipo_dano_reductor,id_usuario,coordenadas)
                VALUES
                ('$fechanreductor','$descripcion','$referencia','$ruta','$direccion','$idEstado','$idTipoReductor','$idTipoDanoReductor','$id_usuario',ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

                $ejecutar = $obj->insert($sql);

                if($ejecutar){
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ok';</script>";
                }else{
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=error';</script>";
                }

            }else{
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=imgerror';</script>";
        }
    }

    public function getUpdate(){
        $obj = new ReportesSolicitudNRModel();

        $id_sol_nuevas_red = $_GET['id'];

        $sql = "SELECT rn.id_sol_nuevas_red, 
                       rn.fecha_nuevo_reductor,
                       rn.descripcion,
                       rn.imagen_url, 
                       rn.direccion, 
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.id_tipo_dano_reductor AS tipo_dano_reductor,  
                       u.numero_id AS usuario
                FROM sol_nuevo_reductor rn 
                LEFT JOIN estado es ON rn.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rn.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rn.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rn.id_usuario = u.id
                WHERE rn.id_sol_nuevas_red = $id_sol_nuevas_red";
        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
        $estados = $obj->select($sql);

        include_once "../view/Reportes/UpdateReportesNR.php";
    }

    public function postUpdate(){
        $obj = new ReportesSolicitudNRModel();

        $id_sol_nuevas_red = $_POST['id_sol_nuevas_red'];
        $id_estado = $_POST['id_estado'];

        $sql = "UPDATE sol_nuevo_reductor SET id_estado = $id_estado WHERE id_sol_nuevas_red = $id_sol_nuevas_red";

        $ejecutar = $obj->update($sql);

        if ($ejecutar) {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
        } else {
            echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
        }
    }
}
?>