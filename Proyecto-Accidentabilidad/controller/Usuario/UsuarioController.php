<?php
include_once '../model/Usuario/UsuarioModel.php';
class UsuarioController{

function getCreate(){
$obj      = new UsuarioModel();
$sql      = "SELECT * FROM tipo_documento";
$ejecutar = $obj->select($sql);
$sql = "SELECT * FROM barrio";
$barrios = $obj->select($sql);

$tipo = array();
if ($ejecutar && pg_num_rows($ejecutar) > 0) {
    while ($fila = pg_fetch_assoc($ejecutar)) {
        $tipo[] = $fila; 
    }
}
include_once "../web/registro.php";
}

    public function postCreate()
    {
        $obj = new UsuarioModel();
        $tipo_documento = $_POST['tipo_documento'];
        $numero_documento = $_POST['numero_documento'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $salt = "giavpassword0602";
        $contrasenaHash = md5($salt . $contrasena);
        $barrio = $_POST['barrio'];
        $tipo_via = $_POST['tipo_via'];
        $numero1 = strtoupper($_POST['numero1']);
        $comp1 = $_POST['comp1'];
        $cuad1 = $_POST['cuad1'];
        $numero2 = strtoupper($_POST['numero2']);
        $comp2 = $_POST['comp2'];
        $cuad2 = $_POST['cuad2'];
        $numero3 = $_POST['numero3'];
        $direccion = preg_replace('/\s+/', ' ', trim(
        $tipo_via . " " . $numero1 . " " . $comp1 . " " . $cuad1 . " # " . $numero2 . " " . $comp2 . " " .$cuad2 . " - " .$numero3));


        //Esta validacion solo son son numeros deben de ser minimo de 8 digitos y maximo 11 digitos 
        // //Tambien debe ser mayor a 0 osea no puede comenzar con 0 
        // //los numeros pueden ser de 0 a 10
        if (!preg_match('/^[1-9][0-9]{7,10}$/', $numero_documento)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=documento_digitos';</script>";
            exit();
        }

        //verifica que solo sean letras 
        //deja poner la ñ como letra especial y tambien acepta colocar tildes 
        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', $nombre)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=nombre_letra';</script>";
            exit();
        }

        //verifica que solo sean letras 
        //deja poner la ñ como letra especial y tambien acepta colocar tildes 
        if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', $apellido)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=apellido_letra';</script>";
            exit();
        }

        // Valida que el correo pertenezca a un proveedor conocido
        if (!preg_match('/^[A-Za-z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com|live\.com|yahoo\.com|icloud\.com|msn\.com|aol\.com|gmx\.com|zoho\.com|mail\.com|yandex\.com|fastmail\.com|proton\.me|sena\.edu\.co)$/i', $correo)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=correo_formato';</script>";
            exit();
        }

        // La contraseña debe tener mínimo 8 caracteres ,una letra mayúscula y un carácter especial
        if (!preg_match('/^(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/', $contrasena)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=contrasena_formato';</script>";
            exit();
        }

        // El teléfono debe tener exactamente 10 dígitos y contener solo números
        // debe comenzar si o si con 3
        if (!preg_match('/^3[0-9]{9}$/', $telefono)) {
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=telefono_formato';</script>";
            exit();
        }

        //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
        //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
        //Tambien por que puede tener una letra al final
        if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero1)){
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=numero1_formato';</script>";
            exit();
        }

        //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
        //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
        //Tambien por que puede tener una letra al final
        if(!preg_match('/^[1-9][0-9]{0,2}[A-Z]?$/', $numero2)){
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=numero2_formato';</script>";
            exit();
        }

        //Esta validacion permite 3 numeros pero no letra al final
        if(!preg_match('/^[1-9][0-9]{0,2}$/', $numero3)){
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=numero3_formato';</script>";
        exit();
        }

        $sql_validate = "SELECT * FROM usuarios WHERE correo = '$correo' OR numero_id = '$numero_documento'";
        $result_validate = $obj->select($sql_validate);
        if (pg_num_rows($result_validate) > 0) {
            echo "<script>alert('El correo o número de documento ya está registrado.'); window.location.href='" . getUrl('Usuario','Usuario','getCreate',false,'ajax') . "';</script>";
            exit();
        }else{

        $id = $obj -> autoincrement('usuarios', 'id');
    
        $sql = "INSERT INTO usuarios (id, id_tipo_doc, numero_id, nombre, apellido, telefono, correo, contrasena, direccion, id_rol, id_estado ) VALUES ('$id', '$tipo_documento', '$numero_documento', '$nombre', '$apellido', '$telefono', '$correo', '$contrasenaHash', '$direccion', 1, 1)";
        $ejecutar = $obj->insert($sql);
        if ($ejecutar) {

            $_SESSION['exito'] = "Usuario registrado exitosamente. Por favor, inicie sesión.";
            redirect(getUrl('Acceso', 'Acceso', 'login', false, 'ajax'));
        }   else {
            echo "Error al registrar el usuario.";
        }
        }
    }

     public function perfil(){

        $obj = new UsuarioModel();

        $id_usuario = $_SESSION['id'];

        $sql = "SELECT u.*, td.descripcion AS nombre_tipo_doc, r.nombre_rol, e.nombre AS nombre_estado
                FROM usuarios u
                INNER JOIN tipo_documento td ON u.id_tipo_doc = td.id_tipo_doc
                INNER JOIN roles r ON u.id_rol = r.id_rol
                INNER JOIN estado e ON u.id_estado = e.id_estado
                WHERE u.id = '$id_usuario'";

        $usuario = $obj->select($sql);

        include_once "../view/Usuario/PerfilView.php";
    }

    public function getEditPerfil(){

        $obj = new UsuarioModel();

        $id_usuario = $_SESSION['id'];

        $sql = "SELECT u.*, td.descripcion AS nombre_tipo_doc, r.nombre_rol, e.nombre AS nombre_estado
                FROM usuarios u
                INNER JOIN tipo_documento td ON u.id_tipo_doc = td.id_tipo_doc
                INNER JOIN roles r ON u.id_rol = r.id_rol
                INNER JOIN estado e ON u.id_estado = e.id_estado
                WHERE u.id = '$id_usuario'";

        $usuario = $obj->select($sql);

        include_once "../view/Usuario/EditPerfil.php";
    }

    public function postPerfil(){

        $obj = new UsuarioModel();

        $id_usuario = $_SESSION['id'];
        $id_rol     = $_SESSION['id_rol'];

        // ── Datos de contacto: editables por TODOS los roles ─────────────
        $telefono  = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $sql = "UPDATE usuarios SET telefono = '$telefono', direccion = '$direccion'";

        // ── Nombre y Apellido: solo Funcionario (3) y Administrador (2) ──
        if ($id_rol == 2 || $id_rol == 3) {
            $nombre   = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $sql .= ", nombre = '$nombre', apellido = '$apellido'";
        }

        // ── Correo: solo Administrador (2) ────────────────────────────────
        if ($id_rol == 2) {
            $correo = $_POST['correo'];
            $sql .= ", correo = '$correo'";
        }

        $sql .= " WHERE id = '$id_usuario'";

        $ejecutar = $obj->update($sql);

        if (!$ejecutar) {
            $_SESSION['error_perfil'] = "No se pudo actualizar la informacion. Intente nuevamente.";
            redirect(getUrl("Usuario", "Usuario", "getEditPerfil"));
            return;
        }

        // ── Cambio de contrasena: solo Ciudadano (1) y Administrador (2) ──
        if ($id_rol == 1 || $id_rol == 2) {

            $contrasena_actual    = isset($_POST['contrasena_actual']) ? trim($_POST['contrasena_actual']) : '';
            $contrasena_nueva     = isset($_POST['contrasena_nueva']) ? trim($_POST['contrasena_nueva']) : '';
            $contrasena_confirmar = isset($_POST['contrasena_confirmar']) ? trim($_POST['contrasena_confirmar']) : '';

            // Si dejo los 3 campos vacios, no quiere cambiar la contrasena -> se ignora
            if ($contrasena_actual !== '' || $contrasena_nueva !== '' || $contrasena_confirmar !== '') {

                $salt = "giavpassword0602";
                $hash_actual_calculado = md5($salt . $contrasena_actual);

                $sql_check = "SELECT contrasena FROM usuarios WHERE id = '$id_usuario'";
                $res_check = $obj->select($sql_check);
                $fila_check = pg_fetch_assoc($res_check);
                $hash_guardado = $fila_check['contrasena'];

                if ($hash_actual_calculado !== $hash_guardado) {
                    $_SESSION['error_perfil'] = "La contrasena actual no es correcta.";
                    redirect(getUrl("Usuario", "Usuario", "getEditPerfil"));
                    return;
                }

                if ($contrasena_nueva === '' || $contrasena_confirmar === '') {
                    $_SESSION['error_perfil'] = "Debe completar la nueva contrasena y su confirmacion.";
                    redirect(getUrl("Usuario", "Usuario", "getEditPerfil"));
                    return;
                }

                if ($contrasena_nueva !== $contrasena_confirmar) {
                    $_SESSION['error_perfil'] = "La nueva contrasena y su confirmacion no coinciden.";
                    redirect(getUrl("Usuario", "Usuario", "getEditPerfil"));
                    return;
                }

                if (strlen($contrasena_nueva) < 8) {
                    $_SESSION['error_perfil'] = "La nueva contrasena debe tener minimo 8 caracteres.";
                    redirect(getUrl("Usuario", "Usuario", "getEditPerfil"));
                    return;
                }

                $hash_nuevo = md5($salt . $contrasena_nueva);
                $sql_clave  = "UPDATE usuarios SET contrasena = '$hash_nuevo' WHERE id = '$id_usuario'";
                $obj->update($sql_clave);
            }
        }

        $_SESSION['exito_perfil'] = "Perfil actualizado correctamente.";
        redirect(getUrl("Usuario", "Usuario", "perfil"));
    }

}



?>