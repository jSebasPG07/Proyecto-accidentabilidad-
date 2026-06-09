<?php

include_once "../model/Historial/MiHistorialModel.php";

class MiHistorialController {

   public function getList(){
    
        include_once "../view/Historial/MiHistorialView.php";
    }

   public function getFiltrar(){

    $obj = new MiHistorialModel();
    $tipo = $_GET['tipo'] ?? "";

    if($tipo == "accidente"){

        $sql = "SELECT a.id_reporte_acc, 
                       a.fecha_accidente, 
                       a.nomenclatura, 
                       a.num_lesionados, 
                       a.observaciones, 
                       a.direccion, 
                       a.imagen_url,
                       t.nombre AS tipo_choque
                FROM reporte_accidente a
                LEFT JOIN tipo_choque t 
                ON a.id_tipo_choque = t.id_tipo_choque";

        $res = $obj->select($sql);

        // 🔥 CONVERSIÓN CLAVE
        $accidentes = [];
        while($row = pg_fetch_assoc($res)){
            $accidentes[] = $row;
        }

        include "../view/Historial/TablaReportes.php";
        die();
    }
}
}
?>