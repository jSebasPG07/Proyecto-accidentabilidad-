<?php
require_once "model/Reportes/SolicitudNRModel.php";

class SolicitudNRController {
    private $model;

    public function __construct() {
        $this->model = new SolicitudNRModel();
    }

    public function index() {
        $solicitudes = $this->model->obtenerSolicitudes();
        require_once "view/Reportes/solicitudNR.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tipoDano = $_POST['tipo_dano'];
            $descripcion = $_POST['descripcion'];
            $direccion = $_POST['direccion'];
            $idTipoReductor = intval($_POST['id_tipo_reductor']);
            
            $nombreImagen = "";
            if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
                $dirSubida = "web/uploads/reductores/";
                if (!file_exists($dirSubida)) {
                    mkdir($dirSubida, 0777, true);
                }
                $nombreImagen = time() . "_" . basename($_FILES['imagen_url']['name']);
                move_uploaded_file($_FILES['imagen_url']['tmp_name'], $dirSubida . $nombreImagen);
            }

            $this->model->registrarSolicitud($tipoDano, $descripcion, $nombreImagen, $direccion, $idTipoReductor);
            header("Location: index.php?c=SolicitudNR&a=index");
        }
    }

    public function editar() {
        $id = $_GET['id'];
        $solicitud = $this->model->obtenerSolicitudPorId($id);
        $solicitudes = $this->model->obtenerSolicitudes(); 
        require_once "view/Reportes/solicitudNR.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_sol_nuevas_red'];
            $tipoDano = $_POST['tipo_dano'];
            $descripcion = $_POST['descripcion'];
            $direccion = $_POST['direccion'];
            $idTipoReductor = intval($_POST['id_tipo_reductor']);
            
            $nombreImagen = null;
            if (isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
                $dirSubida = "web/uploads/reductores/";
                $nombreImagen = time() . "_" . basename($_FILES['imagen_url']['name']);
                move_uploaded_file($_FILES['imagen_url']['tmp_name'], $dirSubida . $nombreImagen);
            }

            $this->model->actualizarSolicitud($id, $tipoDano, $descripcion, $direccion, $idTipoReductor, $nombreImagen);
            header("Location: index.php?c=SolicitudNR&a=index");
        }
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->model->eliminarSolicitud($id);
        header("Location: index.php?c=SolicitudNR&a=index");
    }
}