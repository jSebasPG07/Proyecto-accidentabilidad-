<?php

include_once "../model/Reportes/ReportesSolicitudNRModel.php";

class ReportesSolicitudNRController {

    public function index(){

        $this->getCreate();
    }

    public function getCreate(){

        $obj = new ReportesSolicitudNRModel();

        include_once "../view/Reportes/ReportesSolicitudNR.php";
    }

    public function postCreate(){

        $obj = new ReportesSolicitudNRModel();

        $tipoDano = $_POST['tipo_dano'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idTipoReductor = $_POST['id_tipo_reductor'];

        $idEstado = 1;

        $nombreImagen = "";
        $archivo = $_FILES['imagen_url']['tmp_name'];

        if(isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0){

            $nombreImagen = time() . "_" . $_FILES['imagen_url']['name'];

            $ruta = "../uploads/reductores/" . $nombreImagen;

            if(move_uploaded_file($archivo, $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor
                        (
                            tipo_dano,
                            descripcion,
                            imagen_url,
                            direccion,
                            id_tipo_reductor,
                            id_estado
                        )
                        VALUES
                        (
                            '$tipoDano',
                            '$descripcion',
                            '$ruta',
                            '$direccion',
                            '$idTipoReductor',
                            '$idEstado'
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

        }else{

            echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=imgerror';</script>";
        }
    }
}

?>