<?php

include_once "../model/Reportes/ReportesSolicitudNRModel.php";

class ReportesSolicitudNRController {

    public function index(){
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
        $this->getCreate();
    }

    public function getCreate(){

        $obj = new ReportesSolicitudNRModel();

<<<<<<< Updated upstream
        $sqlReductor = "SELECT * FROM tipo_reductor";
        $reductores = $obj->select($sqlReductor);

        $sqlDano = "SELECT * FROM tipo_dano_reductor";
        $danos = $obj->select($sqlDano);

=======
>>>>>>> Stashed changes
        include_once "../view/Reportes/ReportesSolicitudNR.php";
    }

    public function postCreate(){

        $obj = new ReportesSolicitudNRModel();

<<<<<<< Updated upstream
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idTipoReductor = $_POST['id_tipo_reductor'];
        $idTipoDanoReductor = $_POST['id_tipo_dano_reductor'];


        $idEstado = 3;
        $id_usuario = $_POST['id'];
=======
        $tipoDano = $_POST['tipo_dano'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $idTipoReductor = $_POST['id_tipo_reductor'];

        $idEstado = 1;

        $nombreImagen = "";
        $archivo = $_FILES['imagen_url']['tmp_name'];
>>>>>>> Stashed changes

        if(isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0){

            $nombreImagen = time() . "_" . $_FILES['imagen_url']['name'];

<<<<<<< Updated upstream
            $ruta = "../img/" . $nombreImagen;

            if(move_uploaded_file($_FILES['imagen_url']['tmp_name'], $ruta)){

                $sql = "INSERT INTO sol_nuevo_reductor
                (
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
                    '$descripcion',
                    '$nombreImagen',
                    '$direccion',
                    '$idEstado',
                    '$idTipoReductor',
                    '$idTipoDanoReductor',
                    '$idUsuario'
                )";
=======
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
>>>>>>> Stashed changes

                $ejecutar = $obj->insert($sql);

                if($ejecutar){
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=ok';</script>";
                }else{
                    echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=error';</script>";
                }

            }else{
<<<<<<< Updated upstream
                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=imgerror';</script>";
            }
=======

                echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=imgerror';</script>";
            }

        }else{

            echo "<script>window.location.href='".getUrl("Reportes","ReportesSolicitudNR","getCreate")."&msg=imgerror';</script>";
>>>>>>> Stashed changes
        }
    }
}

?>