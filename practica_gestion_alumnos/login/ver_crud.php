<?php
// Iniciamos la sesión
session_start();

// Comprobamos si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir al login si no está logueado
    exit;
}

// Simulamos que el tipo de usuario se almacena en la sesión (cambiar según tu implementación)
$tipo_usu = $_SESSION['tipo_usu'] ?? null;

// Verificamos si el usuario es administrador (tipo_usu = 1)
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
    <link rel="stylesheet" href="style.css"> <!-- Agrega estilos si lo deseas -->
</head>
<body>
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
                header("Location: listar_alumno.php");
                exit;
            case 'proyectos':
                header("Location: listar_proyecto.php");
                exit;
            case 'tutores':
                header("Location: listar_tutor.php");
                exit;
            default:
                echo "<p style='color: red;'>Opción no válida.</p>";
        }
    }
    ?>
</body>
</html>
