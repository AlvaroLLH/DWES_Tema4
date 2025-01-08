<?php

// Iniciamos la sesión
session_start();

// Comprobamos si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Simulamos que el tipo de usuario se almacena en la sesión
$tipo_usu = $_SESSION['tipo_usu'] ?? null;

// Verificamos si el usuario es administrador
if ($tipo_usu != 1) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div>
    <a href="cerrar_sesion.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    </div>

    <h1>Bienvenido, Administrador</h1>

    <p>Selecciona una opción:</p>

    <!-- Botones para las opciones -->
    <form action="" method="GET">
        <button type="submit" name="opcion" value="alumnos">Ver Alumnos</button>
        <button type="submit" name="opcion" value="proyectos">Ver Proyectos</button>
        <button type="submit" name="opcion" value="tutores">Ver Tutores</button>
    </form>

    <?php

    // Redirigimos según la opción seleccionada
    if (isset($_GET['opcion'])) {
        switch ($_GET['opcion']) {
            case 'alumnos':
                header("Location: ../alumnos/vista/listar_alumno.php");
                exit;
            case 'proyectos':
                header("Location: ../proyecto/vista/listar_proyecto.php");
                exit;
            case 'tutores':
                header("Location: ../tutor/vista/listar_tutor.php");
                exit;
            default:
                echo "<p style='color: red;'>Opción no válida.</p>";
        }
    }

    ?>

</body>
</html>
