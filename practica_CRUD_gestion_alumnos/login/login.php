<?php

// Iniciamos la sesión
session_start();

// Comprobamos si se ha enviado el formulario
if(isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    // Validamos que ambos campos estén completos
    if(empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y una contraseña";

    } else {
        try {
            // Conexión a la base de datos con PDO
            $pdo = new PDO('mysql:host=localhost;dbname=gestion_alumnos', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener el tipo de usuario y contraseña
            $query = "SELECT tipo_usu, password, activar FROM tutor WHERE login = :login";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':login', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            // Comprobamos que el usuario exista
            if($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificamos si el usuario está activo
                if($resultado['activar'] == 1) {

                    // Verificamos la contraseña
                    if(password_verify($password, $resultado['password'])) {

                        // Almacenamos el usuario en la sesión
                        $_SESSION['usuario'] = $usuario;
                        $_SESSION['tipo_usu'] = $resultado['tipo_usu'];
                        $_SESSION['id_tutor'] = $resultado['id_tutor'];

                        // Redirigimos según el tipo de usuario
                        if($resultado['tipo_usu'] == 1) {
                            header("Location: ver_crud.php");
                            exit;
                        } else if ($resultado['tipo_usu'] == 2) {
                            header("Location: ../tutor/vista/ver_tutor.php");
                            exit;
                        }
                    } else {
                        $error = "Usuario o contraseña no válidos";
                    }
                } else {
                    $error = "Tu cuenta está inactiva. Informa al administrador";
                }
            } else {
                $error = "Usuario o contraseña no válidos";
            }
        } catch (PDOException $e) {
            $error = "Error en la base de datos: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <!-- Contenedor principal -->
    <div class="login-container">
        <h1>Inicio de Sesión</h1>

        <!-- Mostramos un mensaje de error si existe -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Formulario de login -->
        <form action="login.php" method="POST">
            <label for="inputUsuario">Usuario</label>
            <input type="text" id="inputUsuario" name="inputUsuario" required>

            <label for="inputPassword">Contraseña</label>
            <input type="password" id="inputPassword" name="inputPassword" required>

            <button type="submit" name="enviar">Iniciar Sesión</button>
        </form>

    </div>
</body>
</html>