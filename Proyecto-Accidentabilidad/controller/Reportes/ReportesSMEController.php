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
            $fechaaccidente = date("Y-m-d");
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
        
    }
?>