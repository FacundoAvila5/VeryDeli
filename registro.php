<?php
    if (isset($_POST['btn-reg'])) {
        extract($_POST);
        $nameError = $apeError = $emailError = $pass1Error = $pass2Error = "";
        $showModal= false;

        if (empty($name)) { $nameError = "Ingrese el nombre."; }
        if (empty($ape)) { $apeError = "Ingrese el apellido."; }

        if (empty($email)) {
            $emailError = "Ingrese el email.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "El formato del email no es válido.";
        }
        
        if (empty($pass1)) { $pass1Error = "La contraseña es obligatoria."; }
        if (empty($pass2)) { $pass2Error = "Por favor, repita la contraseña."; }
        if (!empty($pass1) && !empty($pass2) && $pass1 != $pass2) {
            $pass1Error = "Las contraseñas no coinciden.";
        }

        //Conexion con la base de datos
        $conn = mysqli_connect('localhost', 'root');
        if (!$conn) { die("Conexión fallida: " . mysqli_connect_error()); }
        mysqli_select_db($conn, 'verydeli');
        // Verificar si el email ya existe
        $sql = "SELECT IdUsuario FROM usuarios WHERE EmailUsuario = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $emailError = "El email ya está registrado.";
        }

        
        if (empty($nameError) && empty($apeError) && empty($emailError) && empty($pass1Error) && empty($pass2Error)) {
            
            // lógica para almacenar los datos en la base de datos
            $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
            $sql="INSERT INTO usuarios (NombreUsuario, ApellidoUsuario, EmailUsuario, Contrasenia, TipoUsuario, Validado) VALUES ('".$name."','".$ape."','".$email."','".$hashed_password."','Normal','0')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showModal=true;
            } else {
                echo "Error: " . mysqli_connect_error();
            }

            mysqli_close($conn);
        } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Very Deli</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid p-0">
        <div class="gradient-bg-animation d-flex justify-content-center align-items-center vh-100">
            
            <div class="row w-50">
                <div class="col-12 col-md-12 bg-light bg-opacity-75 inicio-sesion">
                    <div class="row">
                        <div class="col-11">
                            <h5><strong>Formulario de registro</strong></h5>
                            <div id="emailHelp" class="form-text">* campos obligatorios</div>
                        </div>
                        <div class="col-1">
                            <a href="login.php"><button type="button" class="btn-close" aria-label="Close"></button> </a>
                        </div>
                        <hr>
                    </div>
                    <form action="registro.php" method="post">

                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control <?php echo $nameError!='' ? 'is-invalid' : ''; ?>" placeholder="Nombre *" name="name">
                                <div class="invalid-feedback">
                                    <?php echo isset($nameError) ? $nameError : '' ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control <?php echo $apeError!='' ? 'is-invalid' : ''; ?>" placeholder="Apellido *" name="ape">
                                <div class="invalid-feedback">
                                    <?php echo isset($apeError) ? $apeError : '' ?>
                                </div>
                            </div>   
                        </div>

                        <div class="row pt-3">
                            <div class="col-6">
                                <input type="email" class="form-control <?php echo $emailError!='' ? 'is-invalid' : ''; ?>" placeholder="Email *" name="email">
                                <div class="invalid-feedback">
                                    <?php echo isset($emailError) ? $emailError : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class ="row pt-3">
                            <div class="col-6">
                                <input type="password" class="form-control <?php echo $pass1Error!='' ? 'is-invalid' : ''; ?>" placeholder="Contraseña *"  name="pass1">
                                <div class="invalid-feedback">
                                    <?php echo isset($pass1Error) ? $pass1Error : 'Minimo 8 caracteres.' ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="password" class="form-control <?php echo $pass2Error!='' ? 'is-invalid' : ''; ?>" placeholder="Repita la contraseña *" name="pass2">
                                <div class="invalid-feedback">
                                    <?php echo isset($pass2Error) ? $pass2Error : '' ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row pt-4">
                            <div class="col-4">
                                <input type="text" class="form-control " placeholder="Provincia" name="prov">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Ciudad" name="city">
                            </div>
                        </div> -->

                        <div class="row pt-3 d-flex justify-content-center">
                            <hr>
                            <button name="btn-reg" id="btn-ingresar" type="submit">Registrarse</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Su registro se realizó con éxito. Serás redirigido a la página de inicio de sesión.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/51d2388034.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Mostrar modal si se registró correctamente
        <?php if ($showModal): ?>
            var myModal = new bootstrap.Modal(document.getElementById('successModal'), {});
            myModal.show();
            // Redirigir después de que se cierra el modal
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                window.location.href = 'login.php';
            });
        <?php endif; ?>
    </script>
</body>
</html>