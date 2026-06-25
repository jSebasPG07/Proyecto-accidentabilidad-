<?php

include_once "../model/Historial/MiHistorialModel.php";

class MiHistorialController {

   public function getList(){
    
        include_once "../view/Historial/MiHistorialView.php";
    }

   public function getFiltrar(){

    $obj = new MiHistorialModel();
    if (isset($_GET['tipo'])){
        $tipo = $_GET['tipo']; 
    } else {
        $tipo = "";
    }
    

    if($tipo == "accidente"){

        $sql = "SELECT a.id_reporte_acc, 
                       a.fecha_accidente,  
                       a.num_lesionados, 
                       a.observaciones, 
                       a.direccion,
                       es.nombre AS estado,
                       a.imagen_url,
                       t.nombre AS tipo_choque,
                       CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                       u.numero_id AS identificacion
                FROM reporte_accidente a
                LEFT JOIN estado es ON a.id_estado = es.id_estado 
                LEFT JOIN tipo_choque t ON a.id_tipo_choque = t.id_tipo_choque
                LEFT JOIN usuarios u ON a.id_usuario = u.id
                ORDER BY a.id_reporte_acc ASC";

        $res = $obj->select($sql);

        $accidentes = array();
        while($row = pg_fetch_assoc($res)){
            $accidentes[] = $row;
        }

        include "../view/Historial/TablaReportes.php";
        die();
    }

    if($tipo == "senal_nueva"){

        $sql = "SELECT ns.id_sol_nueva_sen,
               ns.fecha_nueva_senal,
               ns.descripcion,
               ns.imagen_url, 
               ns.direccion, 
               ns.referencia,
               es.nombre AS estado, 
               tp.nombre_senal AS tipo_senal, 
               ori.nombre AS orientacion, 
               CONCAT(u.nombre, ' ', u.apellido) AS usuario,
               u.numero_id AS identificacion
        FROM sol_nueva_senal ns 
        LEFT JOIN estado es ON ns.id_estado = es.id_estado 
        LEFT JOIN tipo_senal tp ON ns.id_tipo_senal = tp.id_tipo_senal 
        LEFT JOIN orientacion_senal ori ON ns.id_orientacion = ori.id_orientacion 
        LEFT JOIN usuarios u ON ns.id_usuario = u.id
        ORDER BY ns.id_sol_nueva_sen ASC";

        $res = $obj->select($sql);

        $nuevasenal = array();
        while($row = pg_fetch_assoc($res)){
            $nuevasenal[] = $row;
        }

        
        include "../view/Historial/TablaNuevaSenal.php";
        die();
    }

    if($tipo == "senal_mal"){

        $sql = "SELECT sme.id_sol_mal,
                       sme.fecha_senal_mal_estado,
                       sme.descripcion,
                       sme.imagen_url, 
                       sme.direccion,
                       sme.referencia,
                       es.nombre AS estado, 
                       tp.nombre_senal AS tipo_senal,
                       td.id_tipo_dano_senal AS tipo_dano_senal, 
                       ori.nombre AS orientacion, 
                       CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                       u.numero_id AS identificacion
                FROM sol_senal_mal_estado sme 
                LEFT JOIN estado es ON sme.id_estado = es.id_estado 
                LEFT JOIN tipo_senal tp ON sme.id_tipo_senal = tp.id_tipo_senal
                LEFT JOIN tipo_dano_senal td ON sme.id_tipo_dano_senal = td.id_tipo_dano_senal 
                LEFT JOIN orientacion_senal ori ON sme.id_orientacion = ori.id_orientacion 
                LEFT JOIN usuarios u ON sme.id_usuario = u.id
                ORDER BY sme.id_sol_mal ASC";

        $res = $obj->select($sql);

        $senalmalestado = array();
        while($row = pg_fetch_assoc($res)){
            $senalmalestado[] = $row;
        }

        include "../view/Historial/TablaSMEstado.php";
        die();
    }

    if($tipo == "reductor_nuevo"){

        $sql = "SELECT rn.id_sol_nuevas_red, 
                       rn.fecha_nuevo_reductor,
                       rn.descripcion,
                       rn.imagen_url, 
                       rn.direccion, 
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.id_tipo_dano_reductor AS tipo_dano_reductor,  
                       CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                       u.numero_id AS identificacion
                FROM sol_nuevo_reductor rn 
                LEFT JOIN estado es ON rn.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rn.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rn.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rn.id_usuario = u.id
                ORDER BY rn.id_sol_nuevas_red ASC";

        $res = $obj->select($sql);

        $reductornuevo = array();
        while($row = pg_fetch_assoc($res)){
            $reductornuevo[] = $row;
        }

        include "../view/Historial/TablaReductorN.php";
        die();
    }

    if($tipo == "reductor_mal"){

        $sql = "SELECT rm.id_sol_red_mal, 
                       rm.fecha_reductor_mal_estado,
                       rm.descripcion,
                       rm.imagen_url, 
                       rm.direccion,
                       rm.referencia,
                       es.nombre AS estado, 
                       tr.nombre AS tipo_reductor,
                       tdr.id_tipo_dano_reductor AS tipo_dano_reductor,  
                       CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                       u.numero_id AS identificacion
                FROM sol_reductor_mal_estado rm 
                LEFT JOIN estado es ON rm.id_estado = es.id_estado 
                LEFT JOIN tipo_reductor tr ON rm.id_tipo_reductor = tr.id_tipo_reductor
                LEFT JOIN tipo_dano_reductor tdr ON rm.id_tipo_dano_reductor = tdr.id_tipo_dano_reductor  
                LEFT JOIN usuarios u ON rm.id_usuario = u.id
                ORDER BY rm.id_sol_red_mal ASC";

        $res = $obj->select($sql);

        $reductormal = array();
        while($row = pg_fetch_assoc($res)){
            $reductormal[] = $row;
        }

        include "../view/Historial/TablaReductorME.php";
        die();
    }

    if($tipo == "via_mal"){

        $sql = "SELECT vm.id_sol_via_mal,
                       vm.fecha_via_mal_estado,
                       vm.descripcion,
                       vm.imagen_url, 
                       vm.direccion, 
                       es.nombre AS estado, 
                       tdv.id_tipo_dano_via AS tipo_dano_via,  
                       CONCAT(u.nombre, ' ', u.apellido) AS usuario,
                       u.numero_id AS identificacion
                FROM sol_via_mal_estado vm 
                LEFT JOIN estado es ON vm.id_estado = es.id_estado 
                LEFT JOIN tipo_dano_via tdv ON vm.id_tipo_dano_via = tdv.id_tipo_dano_via  
                LEFT JOIN usuarios u ON vm.id_usuario = u.id
                ORDER BY vm.id_sol_via_mal ASC";
                

        $res = $obj->select($sql);

        $viamal = array();
        while($row = pg_fetch_assoc($res)){
            $viamal[] = $row;
        }

        include "../view/Historial/TablaViaME.php";
        die();
    }
}
}
?>