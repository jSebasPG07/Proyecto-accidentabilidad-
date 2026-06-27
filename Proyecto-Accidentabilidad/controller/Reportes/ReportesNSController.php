<?php

    include_once "../model/Reportes/ReportesNSModel.php";

    class ReportesNSController{
        public function getCreate(){
            $obj = new ReportesNSModel();
            $sql = "SELECT * FROM orientacion_senal";
            $orientacionn = $obj->select($sql);
            $sql = "SELECT * FROM tipo_senal";
            $nsenal = $obj->select($sql);
            include_once "../view/Reportes/ReportesNSView.php";
        }

        public function postCreate(){
            $obj = new ReportesNSModel();

            $fechanueva = date("Y-m-d");
            $orientacion = $_POST['orientacion'];
            $descripcion = $_POST['descripcion'];
            $tipo_via = $_POST['tipo_via'];
            $numero1 = strtoupper($_POST['numero1']);
            $numero2 = $_POST['numero2'];
            $numero3 = $_POST['numero3'];
            $referencia = $_POST['referencia'];
            $direccion = "$tipo_via $numero1 # $numero2 - $numero3";
            $tsenal = $_POST['tsenal'];

            $id_estado = 3;

            $id_usuario = $_POST['id'];
            $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
            $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero1)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=numero1_formato';</script>";
                exit();
            }

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero2)){
               echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=numero2_formato';</script>";
               exit();
             }

            //Esta validacion permite 3 numeros pero no letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}$/', $numero3)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=numero3_formato';</script>";
                exit();
            }

        
            // La descripcion debe Tener máximo 200 caracteres Contener solo letras, espacios, ñ y vocales con tilde.Tener mínimo dos palabras.
            if (!preg_match('/^(?=.{1,200}$)[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s+[A-Za-zÁÉÍÓÚáéíóúÑñ]+)+$/u', trim($descripcion))) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=desc_formato';</script>";
                exit();
            }
            

            // El lugar de referencia debe Tener máximo 200 caracteres Contener solo letras, espacios, ñ y vocales con tilde.Tener mínimo dos palabras.
            if (!preg_match('/^(?=.{1,200}$)[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s+[A-Za-zÁÉÍÓÚáéíóúÑñ]+)+$/u', trim($referencia))) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=ref_formato';</script>";
                exit();
            }

            //Esta validacion es por si no selecciona un punto en el mapa no lo deja hacer el registro
            if($coordX == 0 || $coordY == 0){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=coordenadas';</script>";
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
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=tipoimg';</script>";
                    exit();
                }
            }

            if(move_uploaded_file($archivo, $ruta)){
                $sql = "INSERT INTO sol_nueva_senal 
                (fecha_nueva_senal, descripcion, imagen_url, direccion, referencia, id_estado, id_tipo_senal, id_orientacion, id_usuario, coordenadas)
                VALUES 

                ('$fechanueva','$descripcion','$ruta','$direccion','$referencia','$id_estado','$tsenal','$orientacion','$id_usuario', ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))"; 

                $ejecutar = $obj->insert($sql);

                if($ejecutar){
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=ok';</script>";
                } else {
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=error';</script>";
                }

            } else {
                 echo "<script>window.location.href='".getUrl("Reportes","ReportesNS","getCreate")."&msg=imgerror';</script>";
            }

        }
        
        public function getUpdate(){
            $obj = new ReportesNSModel();
            $id_sol_nueva_sen = $_GET['id'];

            $sql = "SELECT ns.id_sol_nueva_sen,
                       ns.fecha_nueva_senal,
                       ns.descripcion,
                       ns.imagen_url, 
                       ns.direccion, 
                       ns.referencia,
                       es.nombre AS estado, 
                       tp.nombre_senal AS tipo_senal, 
                       ori.nombre AS orientacion, 
                       u.numero_id AS usuario
                FROM sol_nueva_senal ns 
                LEFT JOIN estado es ON ns.id_estado = es.id_estado 
                LEFT JOIN tipo_senal tp ON ns.id_tipo_senal = tp.id_tipo_senal 
                LEFT JOIN orientacion_senal ori ON ns.id_orientacion = ori.id_orientacion 
                LEFT JOIN usuarios u ON ns.id_usuario = u.id
                WHERE ns.id_sol_nueva_sen = $id_sol_nueva_sen";

            $reporte = $obj->select($sql);

            $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
            $estados = $obj->select($sql);

            include_once "../view/Reportes/UpdateReporteNS.php";    
        }

        public function postUpdate(){
            $obj = new ReportesNSModel();

            $id_sol_nueva_sen = $_POST['id_sol_nueva_sen'];
            $id_estado = $_POST['id_estado'];

            $sql = "UPDATE sol_nueva_senal SET id_estado = $id_estado WHERE id_sol_nueva_sen = $id_sol_nueva_sen";

            $ejecutar = $obj->update($sql);

            if ($ejecutar) {
                echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=ok';</script>";
            } else {
                echo "<script>window.location.href='" . getUrl("Historial","MiHistorial","getList") . "&msg=error';</script>";
            }
        }
    }
?>