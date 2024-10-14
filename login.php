<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Very Deli</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\icons\loguito-fondoAzulV2.ico" type="image/x-icon">
</head>
<body>
<?php
session_start();
include "ConexionBS.php";
$auth = false;
extract($_POST);

if(isset($correo) && isset($pass)){

    $consulta = "SELECT * FROM usuarios WHERE EmailUsuario = '".$correo."' ";
    $resultado = mysqli_query($conexion, $consulta);

    if(mysqli_num_rows($resultado) > 0){
        $row = mysqli_fetch_assoc($resultado);
        $clave = $row['Contrasenia'];
        $_SESSION["usuario"] = $row['NombreUsuario'] ." ". $row['ApellidoUsuario'];
        $_SESSION["idUser"] = $row['IdUsuario'];
        if(password_verify($pass, $clave)){
            $auth = true;
        }
    }

    if($auth){
        session_start();
        header("Location: PaginaPrincipal.php?" . session_id());
        exit();
    }else{
        $mensajeError = "El correo o contraseña son incorrectos, verifique.";
        ?>
        <div class="container-fluid p-0">
        <div class="gradient-bg-animation d-flex justify-content-center align-items-center vh-100">
            <div class="d-flex justify-content-between w-75">
                <div class="col-5">
                    <img src="logos\logo3.svg" alt="" width="90%">
                    <h4 class="text-center slogan pt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</h4>
                </div>
                <div class="col-5 bg-opacity-75 inicio-sesion bg-light">
                    <h5 class="text-center pb-3"><strong>Inicia Sesión</strong></h5>

                    <form class="p-2" method="post" id="loginform">
                        <div class="mb-3">
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Correo" name="correo">
                        </div>
                        <div class="mb-3">
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="pass">
                          <p> <a href="recuperacion.html" class="link-offset-2 link-underline link-underline-opacity-0 small">Olvidé mi contraseña</a> </p>
                        </div>
                                           
                    <!-- Mensaje de error -->
                     
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $mensajeError; ?>  
                        </div>
                        <div class="d-grid gap-2 col-4 mx-auto justify-content-center m-0">
                            <button id="btn-ingresar">Ingresar</button>
                        </div>
                    </form>
                    <div class="m-0 pt-2 text-center">
                        <hr>
                        <p>¿No tienes una cuenta? <a href="registro.php" class="link-offset-2 link-underline link-underline-opacity-0">Registrarse</a> </p>
                    </div>
                    <div class="icons-div text-center">
                        <a href="www.facebook.com" class="icons p-4"><i class="fa-brands fa-square-facebook"></i></a>
                        <a href="www.instagram.com" class="icons p-4"><i class="fa-brands fa-square-instagram"></i></a>
                        <a href="www.x.com" class="icons p-4"><i class="fa-brands fa-square-x-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/51d2388034.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <?php
    }


}else{
?>
    <div class="container-fluid p-0">
        <div class="gradient-bg-animation d-flex justify-content-center align-items-center vh-100">
            <div class="d-flex justify-content-between w-75 row">
                <div class="col-12 col-md-5 div-logo">
                    <img src="logos\logo3.svg" alt="" width="90%">
                    <!-- mejores logos: logo3 logo-azul  -->
                     
                     <h4 class="text-center slogan pt-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</h4>
                </div>
                <div class="col-12 col-md-5 bg-opacity-75 inicio-sesion bg-light">

                    <h5 class="text-center pb-3"><strong>Iniciar sesión</strong></h5>
                    <form class="p-2" method="post" id="loginform">
                        <div class="mb-3">
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Correo" name="correo">
                          <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-3">
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="pass">
                          <p> <a href="recuperacion.html" class="link-offset-2 link-underline link-underline-opacity-0 small">Olvidé mi contraseña</a> </p>
                        </div>
                        <!-- <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> -->

                        <div class="d-grid gap-2 col-4 mx-auto justify-content-center m-0">
                            <!-- <button type="submit" class="btn btn-primary" id="btn-ingresar"><strong>Ingresar</strong></button> -->
                            <button id="btn-ingresar">Ingresar</button>
                        </div>
                        
                      </form>
                        <div class="m-0 pt-2 text-center">
                            <hr>
                            <p>¿No tienes una cuenta? <a href="registro.php" class="link-offset-2 link-underline link-underline-opacity-0">Registrarse</a> </p>
                        </div>
                        <div class="icons-div text-center">
                            <a href="www.facebook.com" class="icons"><i class="fa-brands fa-square-facebook"></i></a>
                            <a href="www.instagram.com" class="icons"><i class="fa-brands fa-square-instagram"></i></a>
                            <a href="www.x.com" class="icons"><i class="fa-brands fa-square-x-twitter"></i></a>
                         </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/51d2388034.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <?php
}
include "DesconexionBS.php";
?>
</body>
</html>