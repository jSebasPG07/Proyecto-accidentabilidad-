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

    public function getUpdate(){
        $obj = new ReportesSolicitudNRModel();

        $id_sol_nuevas_red = $_GET['id'];

        $sql = "SELECT rn.id_sol_nuevas_red, 
                       rn.fecha_nuevo_reductor,
                       rn.descripcion,
                       rn.imagen_url, 
                       rn.direccion, 
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.id_tipo_dano_reductor AS tipo_dano_reductor,  
                       u.numero_id AS usuario
                FROM sol_nuevo_reductor rn 
                LEFT JOIN estado es ON rn.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rn.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rn.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rn.id_usuario = u.id
                WHERE rn.id_sol_nuevas_red = $id_sol_nuevas_red";
        $reporte = $obj->select($sql);

        $sql = "SELECT * FROM estado WHERE controlador = 'solicitudes';";
    
        $estados = $obj->select($sql);

        include_once "../view/Reportes/UpdateReportesNR.php";
    }

    public function postUpdate(){
        $obj = new ReportesSolicitudNRModel();

        $id_sol_nuevas_red = $_POST{'id_sol_nuevas_red'};
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