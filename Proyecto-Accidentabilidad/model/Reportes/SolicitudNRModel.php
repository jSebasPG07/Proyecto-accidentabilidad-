<?php
require_once "model/MasterModel.php";

class SolicitudNRModel extends MasterModel {
    
    // Registrar una nueva solicitud 
    public function registrarSolicitud($tipoDano, $descripcion, $imagenUrl, $direccion, $idTipoReductor) {
        $sql = "INSERT INTO sol_nuevo_reductor (tipo_dano, descripcion, imagen_url, direccion, id_estado, id_tipo_reductor) 
                VALUES ('$tipoDano', '$descripcion', '$imagenUrl', '$direccion', 1, $idTipoReductor)";
        return $this->insertar($sql);
    }

    // Obtener todas las solicitudes 
    public function obtenerSolicitudes() {
        $sql = "SELECT s.*, e.nombre_estado, t.nombre_reductor 
                FROM sol_nuevo_reductor s
                LEFT JOIN estado e ON s.id_estado = e.id_estado
                LEFT JOIN tipo_reductor t ON s.id_tipo_reductor = t.id_tipo_reductor
                ORDER BY s.id_sol_nuevas_red DESC";
        return $this->consultar($sql);
    }

    // Obtener una solicitud específica 
    public function obtenerSolicitudPorId($id) {
        $sql = "SELECT * FROM sol_nuevo_reductor WHERE id_sol_nuevas_red = $id";
        return $this->consultar($sql);
    }

    // Actualizar una solicitud 
    public function actualizarSolicitud($id, $tipoDano, $descripcion, $direccion, $idTipoReductor, $imagenUrl = null) {
        if ($imagenUrl) {
            $sql = "UPDATE sol_nuevo_reductor 
                    SET tipo_dano = '$tipoDano', descripcion = '$descripcion', direccion = '$direccion', id_tipo_reductor = $idTipoReductor, imagen_url = '$imagenUrl' 
                    WHERE id_sol_nuevas_red = $id AND id_estado = 1";
        } else {
            $sql = "UPDATE sol_nuevo_reductor 
                    SET tipo_dano = '$tipoDano', descripcion = '$descripcion', direccion = '$direccion', id_tipo_reductor = $idTipoReductor 
                    WHERE id_sol_nuevas_red = $id AND id_estado = 1";
        }
        return $this->editar($sql);
    }

    // Eliminar la solicitud 
    public function eliminarSolicitud($id) {
        $sql = "DELETE FROM sol_nuevo_reductor WHERE id_sol_nuevas_red = $id AND id_estado = 1";
        return $this->eliminar($sql);
    }
}