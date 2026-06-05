<?php 

include_once "../model/Reportes/ReportesRMEModel.php";

class ReportesRMEController {

    public function getCreate() {
        $obj = new ReportesRMEModel();
        $sql = "SELECT * FROM tipo_reductor";
        $tiposReductor = $obj->select($sql);
        include_once "../view/Reportes/ReportesRMEView.php";
    }

    public function postCreate() {
        $obj = new ReportesRMEModel();

        $tipodano    = $_POST['tipodano'];
        $descripcion = $_POST['descripcion'];
        $direccion   = $_POST['direccion'];
        $idtipored   = $_POST['idtipored'];

        $imagen_url = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] ==0) {
            $nombreImagen = time() . '_' . $_FILES['imagen']['name'];
            $ruta = '../uploads/' . $nombreImagen;
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
            $imagen_url = $ruta;
        }

        $sql = "INSERT INTO sol_reductor_mal_estado (tipo_dano, descripcion, imagen_url, direccion, id_estado, id_tipo_reductor) 
                VALUES ('$tipodano', '$descripcion', '$imagen_url', '$direccion', 3, '$idtipored')";

        $obj->insert($sql);

        header("Location: index.php?modulo=Reportes&controlador=ReportesRME&funcion=getCreate");
    }

}

?>