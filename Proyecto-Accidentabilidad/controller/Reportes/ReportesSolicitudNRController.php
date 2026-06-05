<?php

include_once "../model/Reportes/ReportesSolicitudNRModel.php";

class ReportesSolicitudNRController {
    
    private $model;

    public function __construct() {
        $this->model = new ReportesSolicitudNRModel();
    }

    public function index() {
        $solitudes = $this->model->obtenerSolicitudes(); 
        include_once "../view/Reportes/ReportesSolicitudNR.php";
    }

    public function getEditar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $solicitud = $this->model->obtenerSolicitudPorId($id);
            $solitudes = $this->model->obtenerSolicitudes(); 
            include_once "../view/Reportes/ReportesSolicitudNR.php";
        } else {
            redirect(getUrl("Reportes", "ReportesSolicitudNR", "index"));
        }
    }

    public function getEliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->eliminarSolicitud($id);
        }
        redirect(getUrl("Reportes", "ReportesSolicitudNR", "index"));
    }

    public function postCrear() {
        if (isset($_POST['tipo_dano'])) {
            $tipoDano = $_POST['tipo_dano'];
            $descripcion = $_POST['descripcion'];
            $direccion = $_POST['direccion'];
            $idTipoReductor = $_POST['id_tipo_reductor'];
            
            $nombreImagen = "";
            if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
                $carpetaDestino = "uploads/reductores/";
                if (!file_exists($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }
                $nombreImagen = time() . "_" . $_FILES['imagen_url']['name'];
                move_uploaded_file($_FILES['imagen_url']['tmp_name'], $carpetaDestino . $nombreImagen);
            }

            $this->model->registrarSolicitud($tipoDano, $descripcion, $nombreImagen, $direccion, $idTipoReductor);
        }
        
        redirect(getUrl("Reportes", "ReportesSolicitudNR", "index"));
    }

    public function postActualizar() {
        if (isset($_POST['id_sol_nuevas_red'])) {
            $id = $_POST['id_sol_nuevas_red'];
            $tipoDano = $_POST['tipo_dano'];
            $descripcion = $_POST['descripcion'];
            $direccion = $_POST['direccion'];
            $idTipoReductor = $_POST['id_tipo_reductor'];
            
            $nombreImagen = null;
            if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
                $carpetaDestino = "uploads/reductores/";
                $nombreImagen = time() . "_" . $_FILES['imagen_url']['name'];
                move_uploaded_file($_FILES['imagen_url']['tmp_name'], $carpetaDestino . $nombreImagen);
            }

            $this->model->actualizarSolicitud($id, $tipoDano, $descripcion, $direccion, $idTipoReductor, $nombreImagen);
        }
        
        redirect(getUrl("Reportes", "ReportesSolicitudNR", "index"));
    }
}
?>