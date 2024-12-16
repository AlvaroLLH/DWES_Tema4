<?php

// Iniciamos la sesión
session_start();

// Comprobamos si ya se ha enviado el formulario
if(isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    // Validamos que se hayan recibido ambos parámetros
    if(empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include("index_.php");

    } else {

        // Conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'pruebas');
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Preparamos la consulta SQL para obtener el tipo de usuario
        $query = "SELECT tipo_usu, password FROM users WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tipo_usu, $hashed_password);

        // Comprobamos si el usuario existe
        if ($stmt->num_rows > 0) {
            $stmt->fetch();

            // Verificamos la contraseña
            if (password_verify($password, $hashed_password)) {

                // Almacenamos el usuario en la sesión
                $_SESSION['usuario'] = $usuario;

                // Redirigimos según el valor de tipo_usu
                if ($tipo_usu == 1) {
                    header("Location: index_admin.php");
                    exit;

                } else if ($tipo_usu == 2) {
                    header("Location: index_usu.php");
                    exit;
                } 

            } else {

                // Si la contraseña no es válida
                $error = "¡Usuario o contraseña no válidos!";
                include("index_.php");
            }
        } else {

            $error = "¡Usuario o contraseña no válidos!";
            include("index_.php");
        }

        // Cerramos la conexión
        $stmt->close();
        $conn->close();
    }
}
?>