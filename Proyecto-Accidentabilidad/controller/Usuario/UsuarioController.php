<?php
include_once '../model/Usuario/UsuarioModel.php';
class UsuarioController{

function getCreate(){
$obj      = new UsuarioModel();
$sql      = "SELECT * FROM tipo_documento";
$ejecutar = $obj->select($sql);

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
        $tipo_via = $_POST['tipo_via'];
        $numero1 = strtoupper($_POST['numero1']);
        $numero2 = $_POST['numero2'];
        $numero3 = $_POST['numero3'];
        $direccion = "$tipo_via $numero1 # $numero2 - $numero3";


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
        if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero1)){
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=numero1_formato';</script>";
            exit();

            
        }

        //Esta validacion es para que en el campo de numero de via acepte numeros del 0 a 9
        //Tambien solo para que en el campo solo se puedan poner 3 digitos osea digamso 123
        //Tambien por que puede tener una letra al final
        if(!preg_match('/^[0-9]{1,3}[A-Z]?$/', $numero2)){
            echo "<script>window.location.href='".getUrl("Usuario","Usuario","getCreate",false,'ajax')."&msg=numero2_formato';</script>";
            exit();
        }

        //Esta validacion permite 3 numeros pero no letra al final
        if(!preg_match('/^[0-9]{1,3}$/', $numero3)){
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
}



?>