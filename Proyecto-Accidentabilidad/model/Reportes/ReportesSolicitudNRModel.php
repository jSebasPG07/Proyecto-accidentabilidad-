<?php
include_once "../model/MasterModel.php";

class ReportesSolicitudNRModel extends MasterModel {

    public function obtenerSolicitudes() {
        $sql = "SELECT s.*, e.nombre as est_nombre 
                FROM sol_nuevo_reductor s 
                JOIN estado e ON s.id_estado = e.id_estado 
                ORDER BY s.id_sol_nuevas_red DESC";
        return $this->select($sql); // Corregido a select()
    }

    public function registrarSolicitud($tipoDano, $descripcion, $imagenUrl, $direccion, $idTipoReductor) {
        $sql = "INSERT INTO sol_nuevo_reductor (tipo_dano, descripcion, imagen_url, direccion, id_tipo_reductor, id_estado) 
                VALUES ('$tipoDano', '$descripcion', '$imagenUrl', '$direccion', $idTipoReductor, 1)";
        return $this->insert($sql);
    }

    public function obtenerSolicitudPorId($id) {
        $sql = "SELECT * FROM sol_nuevo_reductor WHERE id_sol_nuevas_red = $id";
        return $this->select($sql);
    }

    public function actualizarSolicitud($id, $tipoDano, $descripcion, $direccion, $idTipoReductor, $imagenUrl = null) {
        if ($imagenUrl != null) {
            $sql = "UPDATE sol_nuevo_reductor SET 
                    tipo_dano = '$tipoDano', 
                    descripcion = '$descripcion', 
                    direccion = '$direccion', 
                    id_tipo_reductor = $idTipoReductor, 
                    imagen_url = '$imagenUrl' 
                    WHERE id_sol_nuevas_red = $id";
        } else {
            $sql = "UPDATE sol_nuevo_reductor SET 
                    tipo_dano = '$tipoDano', 
                    descripcion = '$descripcion', 
                    direccion = '$direccion', 
                    id_tipo_reductor = $idTipoReductor 
                    WHERE id_sol_nuevas_red = $id";
        }
        return $this->update($sql);
    }

    public function eliminarSolicitud($id) {
        $sql = "DELETE FROM sol_nuevo_reductor WHERE id_sol_nuevas_red = $id";
        return $this->delete($sql);
    }
}
?>