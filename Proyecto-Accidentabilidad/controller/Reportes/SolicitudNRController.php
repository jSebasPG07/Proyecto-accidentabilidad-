<?php

include_once "../model/Reportes/SolicitudNRModel.php";

class SolicitudNRController {
    
    private $model;

    public function __construct() {
        $this->model = new SolicitudNRModel();
    }

    // 1. Pantalla principal 
    public function index() {
        $solicitudes = $this->model->obtenerSolicitudes();
        include_once "../view/Reportes/solicitudNR.php";
    }

    // 2. Función para Guardar un registro nuevo
   public function crear() {
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

            // Registra la solicitud en la BD
            $this->model->registrarSolicitud($tipoDano, $descripcion, $nombreImagen, $direccion, $idTipoReductor);
        }
        
        // Redirecciona automáticamente al listado del módulo
        redirect(getUrl("Reportes", "SolicitudNR", "index"));
    }

    // 3. Función para buscar los datos y ponerlos en el formulario para editar
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $solicitud = $this->model->obtenerSolicitudPorId($id);
            $solicitudes = $this->model->obtenerSolicitudes(); 
            include_once "../view/Reportes/solicitudNR.php";
        }
    }

    // 4. Función para guardar los datos ya modificados
    public function actualizar() {
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
        
        // Redirección 
        redirect(getUrl("Reportes", "SolicitudNR", "index"));
    }

    // 5. Función para eliminar un registro
    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->eliminarSolicitud($id);
        }
        
        // Redirección 
        redirect(getUrl("Reportes", "SolicitudNR", "index"));
    }
}
?>