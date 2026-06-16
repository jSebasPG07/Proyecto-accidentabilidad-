<?php

class Permisos {

    public static function hasModule($idModulo){

        //Si no tiene permisos asignados, no tiene acceso a ningún módulo
        if(!isset($_SESSION['permisos'])){
            return false;
        }

        //Recorrer los permisos del usuario para verificar si tiene acceso al módulo
        foreach($_SESSION['permisos'] as $permiso){

            //Si el permiso coincide con el módulo solicitado, se concede acceso
            if($permiso['modulo_id'] == $idModulo){
                return true;
            }

        }

        //Si no se encuentra ningún permiso para el módulo, se deniega el acceso
        return false;
    }

    public static function hasPermission($idModulo, $idAccion){

        if(!isset($_SESSION['permisos'])){
            return false;
        }

        foreach($_SESSION['permisos'] as $permiso){
    
            //Si el permiso coincide con la acción solicitada, se concede acceso
            if($permiso['modulo_id'] == $idModulo && $permiso['accion_id'] == $idAccion){
                return true;
            }

        }

        return false;
    }

}
?>