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
                (descripcion, imagen_url, direccion, id_estado, id_tipo_senal, id_orientacion, id_usuario)
                VALUES 
                ('$descripcion','$ruta','$direccion','$id_estado','$tsenal','$orientacion', '$id_usuario')"; 

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