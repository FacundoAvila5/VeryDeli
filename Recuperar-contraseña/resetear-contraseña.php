<?php
session_start();
include "../ConexionBS.php";

$message = '';
$success_message = '';

if (isset($_GET['id'])) {
    $idUsu = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nueva_contrasenia = $_POST['nueva_contrasenia'] ?? '';
        $confirmar_contrasenia = $_POST['confirmar_contrasenia'] ?? '';

        if (empty($nueva_contrasenia) || empty($confirmar_contrasenia)) {
            $message = "Por favor, ingresa ambas contraseñas.";
        } else {
            if ($nueva_contrasenia !== $confirmar_contrasenia) {
                $message = "Las contraseñas no coinciden.";
            } else {
                $nueva_contrasenia_encriptada = password_hash($nueva_contrasenia, PASSWORD_DEFAULT);

                $sql_update = "UPDATE usuarios SET Contrasenia = '$nueva_contrasenia_encriptada' WHERE IdUsuario = '$idUsu'";
                if (mysqli_query($conexion, $sql_update)) {
                    $_SESSION['success_message'] = "Tu contraseña ha sido cambiada exitosamente."; 
                    header("Location: ../login.php"); 
                    exit();
                } else {
                    $message = "Hubo un error al cambiar la contraseña. Intenta nuevamente.";
                }
            }
        }
    }

} else {
    $message = "Enlace no válido o expirado.";
}

include "../DesconexionBS.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Restablecer Contraseña</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-danger"><?php echo $message; ?></div>
                        <?php endif; ?>

                        <?php if ($success_message): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="resetear-contraseña.php?id=<?php echo urlencode($idUsu); ?>">
                            <div class="mb-3">
                                <label for="nueva_contrasenia" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="nueva_contrasenia" name="nueva_contrasenia" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_contrasenia" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirmar_contrasenia" name="confirmar_contrasenia" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
