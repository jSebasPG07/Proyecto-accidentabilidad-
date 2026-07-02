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

            $sql = "SELECT * FROM barrio";
            $barrios = $obj->select($sql);
            include_once "../view/Reportes/ReportesSolicitudNR.php";
        }

        public function postCreate(){

            $obj = new ReportesSolicitudNRModel();

            $fechanreductor = date("d-m-y");
            $tipo_via = $_POST['tipo_via'];
            $descripcion = $_POST['descripcion'];
            $barrio = $_POST['barrio'];
            $tipo_via = $_POST['tipo_via'];
            $numero1 = strtoupper($_POST['numero1']);
            $comp1 = $_POST['comp1'];
            $cuad1 = $_POST['cuad1'];
            $numero2 = strtoupper($_POST['numero2']);
            $comp2 = $_POST['comp2'];
            $cuad2 = $_POST['cuad2'];
            $numero3 = $_POST['numero3'];
            $direccion = preg_replace('/\s+/', ' ', trim(
            $tipo_via . " " . $numero1 . " " . $comp1 . " " . $cuad1 . " # " . $numero2 . " " . $comp2 . " " .$cuad2 . " - " .$numero3));
            $referencia = $_POST['referencia'];
            $idTipoReductor = $_POST['id_tipo_reductor'];
            $idTipoDanoReductor = $_POST['id_tipo_dano_reductor'];


            $idEstado = 3;
            $id_usuario = $_POST['id'];
            $coordX = floatval(isset($_POST['coord_x']) ? $_POST['coord_x'] : 0);
            $coordY = floatval(isset($_POST['coord_y']) ? $_POST['coord_y'] : 0);

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero1)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero1_formato';</script>";
                exit();
            }

            //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
            //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
            //Tambien por que puede tener una letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero2)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero2_formato';</script>";
                exit();
            }

            //Esta validacion permite 3 numeros pero no letra al final
            if(!preg_match('/^[1-9][0-9]{0,2}$/', $numero3)){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=numero3_formato';</script>";
                exit();
            }

        
            // La descripcion debe Tener máximo 200 caracteres Contener solo letras, espacios, ñ y vocales con tilde.Tener mínimo dos palabras.
            if (!preg_match('/^(?=.{1,200}$)[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s+[A-Za-zÁÉÍÓÚáéíóúÑñ]+)+$/u', trim($descripcion))) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=desc_formato';</script>";
                exit();
            }
            

            // El lugar de referencia debe Tener máximo 200 caracteres Contener solo letras, espacios, ñ y vocales con tilde.Tener mínimo dos palabras.
            if (!preg_match('/^(?=.{1,200}$)[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s+[A-Za-zÁÉÍÓÚáéíóúÑñ]+)+$/u', trim($referencia))) {
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ref_formato';</script>";
                exit();
            }

            //Esta validacion es por si no selecciona un punto en el mapa no lo deja hacer el registro
            if($coordX == 0 || $coordY == 0){
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=coordenadas';</script>";
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
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=tipoimg';</script>";
                    exit();
                }
            }



            if(move_uploaded_file($archivo, $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor(
                fecha_nuevo_reductor,descripcion,referencia,imagen_url,direccion,id_estado,id_tipo_reductor,id_tipo_dano_reductor,id_usuario,id_barrio,coordenadas)
                VALUES
                ('$fechanreductor','$descripcion','$referencia','$ruta','$direccion','$idEstado','$idTipoReductor','$idTipoDanoReductor','$id_usuario','$barrio',ST_SetSRID(ST_MakePoint($coordX, $coordY), 4326))";

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
                       rn.referencia,
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.descripcion AS tipo_dano_reductor,  
                       u.numero_id AS usuario,
                       b.nombre AS Barrio
                FROM sol_nuevo_reductor rn 
                LEFT JOIN estado es ON rn.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rn.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rn.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rn.id_usuario = u.id
                LEFT JOIN barrio b ON rn.id_barrio = b.id_barrio
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