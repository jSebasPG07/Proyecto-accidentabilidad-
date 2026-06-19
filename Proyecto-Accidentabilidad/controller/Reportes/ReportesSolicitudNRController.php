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
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idTipoReductor = $_POST['id_tipo_reductor'];
        $idTipoDanoReductor = $_POST['id_tipo_dano_reductor'];


        $idEstado = 3;
        $id_usuario = $_POST['id'];
        $img = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "../img/" . $img;


            if(move_uploaded_file($archivo, $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor
                (   
                    fecha_nuevo_reductor,
                    descripcion,
                    imagen_url,
                    direccion,
                    id_estado,
                    id_tipo_reductor,
                    id_tipo_dano_reductor,
                    id_usuario
                )
                VALUES
                (   
                    '$fechanreductor',
                    '$descripcion',
                    '$ruta',
                    '$direccion',
                    '$idEstado',
                    '$idTipoReductor',
                    '$idTipoDanoReductor',
                    '$id_usuario'
                )";

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
}
?>