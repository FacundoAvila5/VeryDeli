<?php
session_start();
include "../ConexionBS.php";
require '../vendor/autoload.php';

unset($_SESSION['alerta_envio_correo']); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (!empty($email)) {
        $sql = "SELECT * FROM usuarios WHERE EmailUsuario = '$email'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $user = mysqli_fetch_assoc($resultado);
            $nombre_usuario = $user['NombreUsuario'];
            $idUsu = $user['IdUsuario'];

            $reset_link = "http://localhost/VeryDeli/VeryDeli/Recuperar-contrasenia/resetear-contrasenia.php?id=" . urlencode($idUsu);

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'testverydeli@gmail.com'; 
            $mail->Password = 'jcvephifxqqefrkk'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom($email, 'Recuperación de Contraseña');
            $mail->addAddress($email, $nombre_usuario); 

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de Contraseña';
            $mail->Body = "Hola $nombre_usuario,<br><br>Para recuperar tu contraseña, por favor ingresa al siguiente enlace: <a href='$reset_link'>$reset_link</a><br><br>Si no solicitaste este cambio, ignora este mensaje.";

            if ($mail->send()) {
                $message = "Te hemos enviado un correo con los pasos para recuperar tu contraseña.";
                $_SESSION['alerta_envio_correo'] = $message; 
            } else {
                $message = "Hubo un error al enviar el correo. Intenta nuevamente.";
            }
        } else {
            $message = "El correo electrónico no está registrado.";
        }
    } else {
        $message = "Por favor ingresa un correo electrónico.";
    }
}

include "../DesconexionBS.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Recuperación de Contraseña</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="recuperacion.php">
                            <?php if ($message): ?>
                                <div class="alert alert-info"><?php echo $message; ?></div>
                            <?php endif; ?>

                            <?php if (!isset($_SESSION['alerta_envio_correo'])): ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Ingrese su correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="example@dominio.com">
                            </div>
                            

                            <button type="submit" class="btn text-white" style="background-color: rgb(18, 146, 154); border-color: rgb(18, 146, 154);">Enviar</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
