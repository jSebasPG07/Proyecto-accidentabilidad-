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

        $accidentes = [];
        while($row = pg_fetch_assoc($res)){
            $accidentes[] = $row;
        }

        include "../view/Historial/TablaReportes.php";
        die();
    }

    if($tipo == "senal_nueva"){

        $sql = "SELECT ns.id_sol_nueva_sen, 
                       ns.descripcion,
                       ns.imagen_url, 
                       ns.direccion, 
                       es.nombre AS estado, 
                       tp.nombre_senal AS tipo_senal, 
                       ori.nombre AS orientacion, 
                       u.numero_id AS usuario
                FROM sol_nueva_senal ns 
                LEFT JOIN estado es ON ns.id_estado = es.id_estado 
                LEFT JOIN tipo_senal tp ON ns.id_tipo_senal = tp.id_tipo_senal 
                LEFT JOIN orientacion_senal ori ON ns.id_orientacion = ori.id_orientacion 
                LEFT JOIN usuarios u ON ns.id_usuario = u.id";

        $res = $obj->select($sql);

        $nuevasenal = [];
        while($row = pg_fetch_assoc($res)){
            $nuevasenal[] = $row;
        }

        include "../view/Historial/TablaNuevaSeñal.php";
        die();
    }

    if($tipo == "senal_mal"){

        $sql = "SELECT sme.id_sol_mal, 
                       sme.descripcion,
                       sme.imagen_url, 
                       sme.direccion, 
                       es.nombre AS estado, 
                       tp.nombre_senal AS tipo_senal,
                       td.id_tipo_dano_senal AS tipo_dano_senal, 
                       ori.nombre AS orientacion, 
                       u.numero_id AS usuario
                FROM sol_senal_mal_estado sme 
                LEFT JOIN estado es ON sme.id_estado = es.id_estado 
                LEFT JOIN tipo_senal tp ON sme.id_tipo_senal = tp.id_tipo_senal
                LEFT JOIN tipo_dano_senal td ON sme.id_tipo_dano_senal = td.id_tipo_dano_senal 
                LEFT JOIN orientacion_senal ori ON sme.id_orientacion = ori.id_orientacion 
                LEFT JOIN usuarios u ON sme.id_usuario = u.id";

        $res = $obj->select($sql);

        $senalmalestado = [];
        while($row = pg_fetch_assoc($res)){
            $senalmalestado[] = $row;
        }

        include "../view/Historial/TablaSMEstado.php";
        die();
    }

    if($tipo == "reductor_nuevo"){

        $sql = "SELECT rn.id_sol_nuevas_red, 
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
                LEFT JOIN usuarios u ON rn.id_usuario = u.id";

        $res = $obj->select($sql);

        $reductornuevo = [];
        while($row = pg_fetch_assoc($res)){
            $reductornuevo[] = $row;
        }

        include "../view/Historial/TablaReductorN.php";
        die();
    }

    if($tipo == "reductor_mal"){

        $sql = "SELECT rm.id_sol_red_mal, 
                       rm.descripcion,
                       rm.imagen_url, 
                       rm.direccion, 
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.id_tipo_dano_reductor AS tipo_dano_reductor,  
                       u.numero_id AS usuario
                FROM sol_reductor_mal_estado rm 
                LEFT JOIN estado es ON rm.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rm.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rm.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rm.id_usuario = u.id";

        $res = $obj->select($sql);

        $reductormal = [];
        while($row = pg_fetch_assoc($res)){
            $reductormal[] = $row;
        }

        include "../view/Historial/TablaReductorME.php";
        die();
    }

    if($tipo == "via_mal"){

        $sql = "SELECT vm.id_sol_via_mal, 
                       vm.descripcion,
                       vm.imagen_url, 
                       vm.direccion, 
                       es.nombre AS estado, 
                       tdv.id_tipo_dano_via AS tipo_dano_via,  
                       u.numero_id AS usuario
                FROM sol_via_mal_estado vm 
                LEFT JOIN estado es ON vm.id_estado = es.id_estado 
                LEFT JOIN tipo_dano_via tdv ON vm.id_tipo_dano_via = tdv.id_tipo_dano_via  
                LEFT JOIN usuarios u ON vm.id_usuario = u.id";

        $res = $obj->select($sql);

        $viamal = [];
        while($row = pg_fetch_assoc($res)){
            $viamal[] = $row;
        }

        include "../view/Historial/TablaViaME.php";
        die();
    }
}
}
?>