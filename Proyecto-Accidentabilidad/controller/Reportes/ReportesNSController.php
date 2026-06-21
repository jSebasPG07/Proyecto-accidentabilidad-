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
            $direccion = $_POST['direccion'];
            $tsenal = $_POST['tsenal'];

            $id_estado = 3;

            $id_usuario = $_POST['id'];

            $img = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../img/" . $img;

            if(move_uploaded_file($archivo, $ruta)){
                $sql = "INSERT INTO sol_nueva_senal 
                (fecha_nueva_senal, descripcion, imagen_url, direccion, id_estado, id_tipo_senal, id_orientacion, id_usuario)
                VALUES 
                ('$fechanueva','$descripcion','$ruta','$direccion','$id_estado','$tsenal','$orientacion', '$id_usuario')"; 

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

            $id_sol_nueva_sen = $_POST{'id_sol_nueva_sen'};
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