<?php

    include_once "../model/Reportes/ReportesNSModel.php";

    class ReportesNSController{
        public function getCreate(){
            $obj = new ReportesNSModel();
            $sql = "SELECT * FROM estado";
            $est = $obj->select($sql);
            $sql = "SELECT * FROM tipo_senal";
            $nsenal = $obj->select($sql);
            include_once "../view/Reportes/ReportesNSView.php";
        }

        public function postCreate(){
            $obj = new ReportesNSModel();

            $orientacion = $_POST['orientacion'];
            $descripcion = $_POST['descripcion'];
            $direccion = $_POST['direccion'];
            $tsenal = $_POST['tsenal'];

            $id_estado = 3;

            $img = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../img/" . $img;

            if(move_uploaded_file($archivo, $ruta)){
                $sql = "INSERT INTO sol_nueva_senal 
                (orientacion, descripcion, imagen_url, direccion, id_estado, id_tipo_senal)
                VALUES 
                ('$orientacion','$descripcion','$ruta','$direccion','$id_estado','$tsenal')"; 

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
        
    }
?>