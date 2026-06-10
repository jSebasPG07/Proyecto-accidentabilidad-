<?php
include_once "../model/Acceso/AccesoModel.php";
require_once "../lib/phpmailer/src/Exception.php";
require_once "../lib/phpmailer/src/PHPMailer.php";
require_once "../lib/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AccesoController
{
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
            $_SESSION['id']        = $usu['id'];
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

    // Paso 1: recibir correo y enviar código
    public function enviarCodigo() {
        try {
            $obj = new AccesoModel();
            $correo = $_POST['correo'] ?? '';

            if (empty($correo)) {
                $_SESSION['error_recuperacion'] = 'Todos los campos son obligatorios.';
                redirect('enviarCorreo.php');
                return;
            }

            $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
            $resultado = $obj->select($sql);

            if (pg_num_rows($resultado) > 0) {
                $usuario    = pg_fetch_assoc($resultado);
                $id_usuario = $usuario['id'];
                $codigo     = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

                $sql_codigo = "INSERT INTO token (codigo, id_usuario) VALUES ('$codigo', $id_usuario)";
                $guardado   = $obj->insert($sql_codigo);

                if (!$guardado) {
                    $_SESSION['error_recuperacion'] = 'Error interno. No se pudo procesar su solicitud. Intente más tarde.';
                    redirect('enviarCorreo.php');
                    return;
                }

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'oscarbelal2005@gmail.com';
                    $mail->Password   = 'hmbm hgbv svpl xbwy';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
                    $mail->CharSet    = 'UTF-8';
                    $mail->setFrom('oscarbelal2005@gmail.com', 'GIAV');
                    $mail->addAddress($correo);
                    $mail->Subject = 'Código de recuperación de contraseña - GIAV';
                    $mail->isHTML(true);
                    $mail->Body = "Tu código de verificación es: <b>$codigo</b><br>
                                   Válido por 15 minutos.<br>
                                   Si no solicitaste este código, ignora este mensaje.";
                    $mail->send();
                } catch (Exception $e) {
                    $_SESSION['error_recuperacion'] = 'Fallo en la conexión. Intente más tarde.';
                    redirect('enviarCorreo.php');
                    return;
                }

                $_SESSION['id_usuario_recuperacion'] = $id_usuario;
                $_SESSION['msg_recuperacion'] = 'Se ha enviado un código de 6 dígitos a su correo electrónico.';
                redirect('ingresarCodigo.php');

            } else {
                $_SESSION['error_recuperacion'] = 'El correo ingresado no se encuentra registrado en el sistema.';
                redirect('enviarCorreo.php');
            }

        } catch (Exception $e) {
            $_SESSION['error_recuperacion'] = 'Error interno. No se pudo procesar su solicitud. Intente más tarde.';
            redirect('enviarCorreo.php');
        }
    }

    // Paso 2: validar el código de 6 dígitos
    public function validarCodigo() {
        try {
            $obj = new AccesoModel();
            $id_usuario = $_SESSION['id_usuario_recuperacion'] ?? null;

            if (!$id_usuario) {
                redirect('enviarCorreo.php');
                return;
            }

            $codigo = $_POST['codigo'] ?? '';

            
            $sql = "SELECT * FROM token WHERE id_usuario = $id_usuario AND codigo = '$codigo' AND uso = false AND tiempo >= NOW() - INTERVAL '15 minutes'";
            $resultado = $obj->select($sql);

            if (pg_num_rows($resultado) > 0) {
                // Código correcto: marcarlo como usado
                $sql_usado = "UPDATE token SET uso = true WHERE id_usuario = $id_usuario AND codigo = '$codigo'";
                $obj->update($sql_usado);
                $_SESSION['recuperacion_verificada'] = true;
                redirect('recuperarContra.php');

            } else {
                // Verificar si existe pero expiró (existe sin filtro de tiempo)
                $sql_existe = "SELECT * FROM token WHERE id_usuario = $id_usuario AND codigo = '$codigo' AND uso = false";
                $codigoExiste = $obj->select($sql_existe);

                if ($codigoExiste && pg_num_rows($codigoExiste) > 0) {
                    // Existe pero expiró por tiempo
                    $sql_eliminarC = "DELETE FROM token WHERE id_usuario = $id_usuario AND codigo = '$codigo'";
                    $obj->delete($sql_eliminarC);
                    $_SESSION['error_verificacion'] = 'El código ha expirado. Debe solicitar uno nuevo.';
                    redirect('ingresarCodigo.php');
                    return;
                }

                // CORRECCIÓN 2: incrementar intentos solo cuando el código es incorrecto
                $sql_aumentarIntentos = "UPDATE token SET intentos = intentos + 1 WHERE id_usuario = $id_usuario AND uso = false";
                $obj->update($sql_aumentarIntentos);

                // CORRECCIÓN 3: extraer el valor numérico del resource de PostgreSQL
                $sql_intentos = "SELECT intentos FROM token WHERE id_usuario = $id_usuario AND uso = false ORDER BY tiempo DESC LIMIT 1";
                $res_intentos = $obj->select($sql_intentos);
                $fila_intentos = pg_fetch_assoc($res_intentos);
                $intentos_actuales = (int)($fila_intentos['intentos'] ?? 0);

                if ($intentos_actuales >= 3) {
                    $sql_eliminarI = "DELETE FROM token WHERE id_usuario = $id_usuario AND uso = false";
                    $obj->delete($sql_eliminarI);
                    $_SESSION['error_verificacion'] = 'Sus intentos han finalizado. Solicite un nuevo código.';
                    redirect('ingresarCodigo.php');
                    return;
                }

                $restantes = 3 - $intentos_actuales;
                $_SESSION['error_verificacion'] = "Código no válido. " .
                    ($restantes == 1 ? "Le queda 1 intento." : "Le quedan $restantes intentos.");
                redirect('ingresarCodigo.php');
            }

        } catch (Exception $e) {
            $_SESSION['error_verificacion'] = 'Error inesperado. Intente más tarde.';
            redirect('ingresarCodigo.php');
        }
    }

    // Paso 3: guardar la nueva contraseña
    public function guardarContrasena() {
        try {
            $obj = new AccesoModel();
            if (!isset($_SESSION['recuperacion_verificada'])) {
                redirect('enviarCorreo.php');
                return;
            }

            $id_usuario = $_SESSION['id_usuario_recuperacion'];
            $nueva      = $_POST['nueva_contrasena'] ?? '';
            $confirmar  = $_POST['confirmar_contrasena'] ?? '';

            if (empty($nueva) || empty($confirmar)) {
                $_SESSION['error_nueva'] = 'Todos los campos son obligatorios.';
                redirect('recuperarContra.php');
                return;
            }

            if ($nueva !== $confirmar) {
                $_SESSION['error_nueva'] = 'Las contraseñas no coinciden.';
                redirect('recuperarContra.php');
                return;
            }

            if (strlen($nueva) < 8) {
                $_SESSION['error_nueva'] = 'La contraseña debe tener mínimo 8 caracteres.';
                redirect('recuperarContra.php');
                return;
            }

            $sql_actualizarU = "UPDATE usuarios SET contrasena = '$nueva' WHERE id = $id_usuario";
            $resultado = $obj->update($sql_actualizarU);

            if ($resultado) {
                unset($_SESSION['id_usuario_recuperacion']);
                unset($_SESSION['recuperacion_verificada']);
                $_SESSION['exito_login'] = 'Contraseña actualizada. Ya puede iniciar sesión.';
                // CORRECCIÓN 4: el controller vive en controller/, igual que login() y logout()
                redirect('login.php');
            } else {
                $_SESSION['error_nueva'] = 'No fue posible actualizar la contraseña. Intente nuevamente.';
                redirect('recuperarContra.php');
            }

        } catch (Exception $e) {
            $_SESSION['error_nueva'] = 'Error inesperado. Intente más tarde.';
            redirect('recuperarContra.php');
        }
    }
}
