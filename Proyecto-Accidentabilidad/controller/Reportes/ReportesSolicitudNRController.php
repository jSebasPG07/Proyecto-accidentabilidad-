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
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $complemento = $_POST['complemento'];
            $descripcion = $_POST['descripcion'];
            $direccion = "$tipo_via $numero1 # $numero2 $complemento";
            $idTipoReductor = $_POST['id_tipo_reductor'];
            $idTipoDanoReductor = $_POST['id_tipo_dano_reductor'];


            $idEstado = 3;
            $id_usuario = $_POST['id'];
            $coordX = floatval($_POST['coord_x'] ?? 0);
            $coordY = floatval($_POST['coord_y'] ?? 0);

            //Esta validacion es por que el numero debe ser asi primero numero despues una letra opcional
            // no va permitir letra primero tampoco si se pone un numero espacio y despues la letra 
            if (!preg_match('/^[0-9]+[A-Za-z]?$/', $numero1)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero1';</script>";
            }

            //Esta validacion puede ser un numero o un numero con el guion
            //No va permitir un guion y desoues el numero osea asi (-30)
            if (!preg_match('/^[0-9]+[A-Za-z]?(-[0-9]+)?$/', $numero2)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero2';</script>"; 
            }

        
            //Este campo no puede tener mas de 200 caracteres
            if (strlen($descripcion) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_largo';</script>"; 
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_formato';</script>";   
            }

            //verifica que tenga al menos una letra osea que si ponen 8888 muestra el error
            if (!preg_match('/[A-Za-z]/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_letra';</script>";
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



            if(move_uploaded_file($archivo, $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor(fecha_nuevo_reductor, descripcion, imagen_url, direccion, id_estado, id_tipo_reductor, id_tipo_dano_reductor, id_usuario, coordenadas)
                VALUES('$fechanreductor','$descripcion','$ruta','$direccion','$idEstado','$idTipoReductor','$idTipoDanoReductor','$id_usuario',ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

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