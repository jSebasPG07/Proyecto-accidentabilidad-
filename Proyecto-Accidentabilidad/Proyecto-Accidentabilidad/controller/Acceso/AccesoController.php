<?php
include_once "../model/Acceso/AccesoModel.php";
class AccesoController
{
// esta funcion recibe el correo y la contraseña del usuario, luego hace una consulta a la base de datos para verificar si el usuario existe y si las credenciales son correctas. Si el usuario es encontrado, se almacenan sus datos en la sesión y se redirige al index.php. Si no, se redirige al login.php.
    public function login()
    {
        $obj = new AccesoModel();
        $usu_correo = $_POST['use_correo'];
        $usu_clave = $_POST['use_clave'];

        $sql = "SELECT u.*, r.nombre_rol FROM usuarios AS u , roles AS r WHERE u.correo = '$usu_correo' AND u.contrasena = '$usu_clave' AND u.id_rol = r.id_rol";
        $usuario = $obj->select($sql);

        if (pg_num_rows($usuario) > 0) {

        while ($usu = pg_fetch_assoc($usuario)) {

            $_SESSION['nombre']    = $usu['nombre'];
            $_SESSION['apellido']  = $usu['apellido'];
            $_SESSION['correo']    = $usu['correo'];
            $_SESSION['rol']       = $usu['nombre_rol'];
            $_SESSION['auth']      = "ok";
        }

            redirect("index.php");

        } else {

            redirect("login.php");

        }
    }

    public function logout()
    {
        session_destroy();
        redirect("login.php");
    }

    

}
