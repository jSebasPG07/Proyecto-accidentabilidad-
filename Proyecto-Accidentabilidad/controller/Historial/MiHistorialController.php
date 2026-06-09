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
                    JOIN tipo_choque t 
                    ON a.id_tipo_choque = t.id_tipo_choque";

            $datos = $obj->select($sql);
        }

        if($tipo == "senal_nueva"){
            $sql = "SELECT * FROM sol_senal_nueva";
            $datos = $obj->select($sql);
        }

        if($tipo == "senal_mal"){
            $sql = "SELECT * FROM sol_senal_mal_estado";
            $datos = $obj->select($sql);
        }

        if($tipo == "reductor_nuevo"){
            $sql = "SELECT * FROM sol_reductor_nuevo";
            $datos = $obj->select($sql);
        }

        if($tipo == "reductor_mal"){
            $sql = "SELECT * FROM sol_reductor_mal_estado";
            $datos = $obj->select($sql);
        }

        if($tipo == "via_mal"){
            $sql = "SELECT * FROM sol_via_mal_estado";
            $datos = $obj->select($sql);
        }

    
        exit();
    }

}
?>