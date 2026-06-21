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
            $direccion = $_POST['direccion'];
            $tsenal = $_POST['tsenal'];
            $tdano = $_POST['tdano'];
            $id_usuario = $_POST['id'];

            $id_estado = 3;

            $img = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../img/" . $img;

            if(move_uploaded_file($archivo, $ruta)){
                $sql = "INSERT INTO sol_senal_mal_estado 
                (fecha_senal_mal_estado,descripcion, imagen_url, direccion, id_estado, id_tipo_senal , id_tipo_dano_senal, id_orientacion, id_usuario)
                VALUES 
                ('$fechaaccidente','$descripcion','$ruta','$direccion','$id_estado','$tsenal','$tdano','$orientacion','$id_usuario')"; 

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
            
            $id_sol_mal = $_POST{'id_sol_mal'};
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