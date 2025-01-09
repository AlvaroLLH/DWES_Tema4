<?php

    // Iniciamos la sesión
    session_start();

    // Verificamos que el usuario esté logueado y sea un tutor
    if(!isset($_SESSION['usuario']) || $_SESSION['tipo_usu'] != 2) {
        header("Location: login.php");
        exit;
    }

    // Conexión a la base de datos con PDO
    try {

        $pdo = new PDO('mysql:host=localhost;dbname=gestion_alumnos', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Obtenemos el id_tutor de la sesión
        $id_tutor = $_SESSION['id_tutor'];
    
        // Verificamos que el ID esté presente
        if (!$id_tutor) {
            die("ID de tutor no encontrado en la sesión.");
        }
    
        // Consulta para obtener los datos del tutor
        $query = "SELECT * FROM tutor WHERE id_tutor = :id_tutor";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_tutor', $id_tutor, PDO::PARAM_INT);
        $stmt->execute();
    
        // Verificamos si se encontró el tutor
        if ($stmt->rowCount() > 0) {
            $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
            
        } else {
            die("No se encontró ningún tutor con el ID proporcionado.");
        }

    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Tutor</title>
    <link rel="stylesheet" href="css/estiloTabla.css">
</head>
<body>

    <!-- Botón para cerrar sesión -->
    <a href="../../login/cerrar_sesion.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    
    <h1>Bienvenido, <?php echo $tutor['nombre']; ?></h1>

    <ul>
        <li><strong>Nombre:</strong> <?php echo $tutor['nombre']; ?></li>
        <li><strong>Apellidos:</strong> <?php echo $tutor['apellidos']; ?></li>
        <li><strong>Correo:</strong> <?php echo $tutor['correo']; ?></li>
        <li><strong>Estado:</strong> <?php echo $tutor['baja'] == 0 ? 'Activo' : 'De baja'; ?></li>
    </ul>

</body>
</html>