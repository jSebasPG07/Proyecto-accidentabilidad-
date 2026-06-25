<?php

    include_once "../model/Reportes/ReportesSMEModel.php";

    class ReportesSMEController{
        public function getCreate(){
            $obj = new ReportesSMEModel();
            $sql = "SELECT * FROM tipo_senal";
            $nsenal = $obj->select($sql);
            $sql = "SELECT * FROM tipo_dano_senal";
            $tdano = $obj->select($sql);
            $sql = "SELECT * FROM orientacion_senal";
            $orientacionn = $obj->select($sql);
            include_once "../view/Reportes/ReportesSMEView.php";
        }

        public function postCreate(){
            $obj = new ReportesSMEModel();
            $fechaaccidente = date("d-m-y");
            $orientacion = $_POST['orientacion'];
            $descripcion = $_POST['descripcion'];
            $tipo_via = $_POST['tipo_via'];
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $complemento = $_POST['complemento'];
            $direccion = "$tipo_via $numero1 # $numero2 $complemento";
            $tsenal = $_POST['tsenal'];
            $tdano = $_POST['tdano'];
            $id_usuario = $_POST['id'];

            $id_estado = 3;

            $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
            $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);

            //Esta validacion es por que el numero debe ser asi primero numero despues una letra opcional
            // no va permitir letra primero tampoco si se pone un numero espacio y despues la letra 
            if (!preg_match('/^[0-9]+[A-Za-z]?$/', $numero1)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=numero1';</script>";
            }

            //Esta validacion puede ser un numero o un numero con el guion
            //No va permitir un guion y desoues el numero osea asi (-30)
            if (!preg_match('/^[0-9]+[A-Za-z]?(-[0-9]+)?$/', $numero2)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=numero2';</script>"; 
            }

        
            //Este campo no puede tener mas de 200 caracteres
            if (strlen($descripcion) > 200) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=desc_largo';</script>"; 
            }

            //Esta validacion solo permite caracteres seguros osea letras desde la A-z, numeros, espacios, comas, punto y guion 
            //Esta bloquea los caracteres especiales @$,#,%,!
            if (!preg_match('/^[A-Za-z0-9\s\.\,\-]+$/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=desc_formato';</script>";   
            }

            //verifica que tenga al menos una letra osea que si ponen 8888 muestra el error
            if (!preg_match('/[A-Za-z]/', $descripcion)) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=desc_letra';</script>";
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
                $sql = "INSERT INTO sol_senal_mal_estado 
                (fecha_senal_mal_estado,descripcion, imagen_url, direccion, id_estado, id_tipo_senal , id_tipo_dano_senal, id_orientacion, id_usuario)
                VALUES 
                ('$fechaaccidente','$descripcion','$ruta','$direccion','$id_estado','$tsenal','$tdano','$orientacion','$id_usuario', ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))"; 

                $ejecutar = $obj->insert($sql);

                if($ejecutar){
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=ok';</script>";
                } else {
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=error';</script>";
                }

            } else {
                 echo "<script>window.location.href='".getUrl("Reportes","ReportesSME","getCreate")."&msg=imgerror';</script>";
            }

        }
        public function getUpdate(){
            $obj = new ReportesSMEModel();
            
            $id_sol_mal = $_GET['id'];

            $sql = "SELECT sme.id_sol_mal,
                       sme.fecha_senal_mal_estado,
                       sme.descripcion,
                       sme.imagen_url, 
                       sme.direccion, 
                       es.nombre AS estado, 
                       tp.nombre_senal AS tipo_senal,
                       td.id_tipo_dano_senal AS tipo_dano_senal, 
                       ori.nombre AS orientacion, 
                       u.numero_id AS usuario
                FROM sol_senal_mal_estado sme 
                LEFT JOIN estado es ON sme.id_estado = es.id_estado 
                LEFT JOIN tipo_senal tp ON sme.id_tipo_senal = tp.id_tipo_senal
                LEFT JOIN tipo_dano_senal td ON sme.id_tipo_dano_senal = td.id_tipo_dano_senal 
                LEFT JOIN orientacion_senal ori ON sme.id_orientacion = ori.id_orientacion 
                LEFT JOIN usuarios u ON sme.id_usuario = u.id
                WHERE sme.id_sol_mal = $id_sol_mal";

            $reporte = $obj->select($sql);

            $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
            $estados = $obj->select($sql);

            include_once "../view/Reportes/UpdateReporteSME.php";

        }
        public function postUpdate(){
            $obj = new ReportesSMEModel();
            
            $id_sol_mal = $_POST['id_sol_mal'];
            $id_estado = $_POST['id_estado'];

            $sql = "UPDATE sol_senal_mal_estado SET id_estado = $id_estado WHERE id_sol_mal = $id_sol_mal";

            $ejecutar = $obj->update($sql);

            if ($ejecutar) {
                echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
            } else {
                echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
            }

        }
    }
?>