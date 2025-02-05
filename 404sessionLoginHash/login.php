<?php

// Creamos la contraseña
$password = "admin";

// Almacenamos la contraseña
$cadena_hash = password_hash($password, PASSWORD_DEFAULT);

// Comprobamos si ya se ha enviado el formulario
if(isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    // Validamos que se hayan recibido ambos parámetros
    if(empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include("index_.php");

    } else {

        // Si el usuario es admin y la contraseña es admin
        if($usuario == "admin" && password_verify($password, $cadena_hash)) {

            // Almacenamos el usuario en la sesión
            session_start();
            $_SESSION['usuario'] = $usuario;

            // Cargamos la página principal
            include("main.php");

        } else {

            // Si las credenciales no son válidas, se vuelven a pedir
            $error = "¡Usuario o contraseña no válidos!";
            include("index_.php");
        }
    }
}

?>