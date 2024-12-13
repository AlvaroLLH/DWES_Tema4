<?php

    // Arrancamos la sesión
    session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mostrar sesión</title>
</head>

<body>

    <h1>Datos almacenados en la sesión</h1>

    <?php

    // Mostramos las variables
    if(isset($_SESSION['nombre']) && $_SESSION['edad']){
        echo "<p>Nombre: " . $_SESSION['nombre'] . "</p>";
        echo "<p>Edad: " . $_SESSION['edad'] . "</p>";

    } else {
        echo "<p>No se ha almacenado ningún dato en la sesión</p>";
    }

    // Mostramos el ID de la sesión
    echo "<p>ID de la sesión: " . session_id() . "</p>";

    ?>

    <!-- Mostramos el contenido de la sesión -->
    <h2>Contenido de $_SESSION:</h2>
    <pre><?php print_r($_SESSION); ?></pre>

    <!-- Enlace para eliminar la variable de sesión -->
    <h2>Eliminar la variable de sesión:</h2>
    <a href="eliminar_sesion.php">Eliminar nombre y edad de la sesión</a><br><br>

    <!-- Enlace para eliminar toda la sesión -->
    <h2>Eliminar toda la sesión:</h2>
    <a href="eliminar_toda_sesion.php">Eliminar toda la sesión</a>

</body>
</html>