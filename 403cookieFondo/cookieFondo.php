<?php

// Establecer el color de fondo por defecto (claro)
$backgroundColor = '#90EE90'; // Verde

// Verificar si existe la cookie
if (isset($_COOKIE['theme'])) {

    // Cambiar el color de fondo según el valor de la cookie
    $backgroundColor = $_COOKIE['theme'] === 'dark' ? '#333333' : '#ffffff';
}

// Manejar el formulario para cambiar el tema
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Si se selecciona un tema, actualizar el fondo y guardar la cookie
    if (isset($_POST['theme'])) {
        $theme = $_POST['theme'];
        $backgroundColor = $theme === 'dark' ? '#333333' : '#ffffff';
        setcookie('theme', $theme, time() + 2 * 24 * 60 * 60); // Duración de 2 días

    } else if (isset($_POST['delete_cookie'])) {

        // Si se elimina la cookie, restablecer al tema claro
        setcookie('theme', '', time() - 3600); // Eliminar la cookie
        $backgroundColor = '#ffffff'; // Volver al fondo claro
    }
}

    /*
    Crea una página web donde el usuario pueda elegir si quiere visualizar la aplicación web con fondo
    oscuro o fondo claro. Almacena la elección del usuario con una cookie para que la siguiente vez
    que el usuario se conecte, la página aparezca directamente con ese fondo. Si la cookie no existe, 
    la página se mostrará en fondo claro. Caduca en 2 días
    */

    // Establecemos el color de fondo por defecto
    $backgroundColor = '#90EE90'; // Verde

    // Verificamos si existe la cookie
    if(isset($_COOKIE['tema'])) {

        // Cambiamos el color de fondo según el valor de la cookie
        $backgroundColor = $_COOKIE['tema'] === 'oscuro' ? '#333333' : '#ffffff';

    }

    // Manejamos el formulario para cambiar el tema
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Si seleccionamos un tema, actualizamos el fondo y guardamos la cookie
        if(isset($_POST['tema'])) {
            $tema = $_POST['tema'];
            $backgroundColor = $tema === 'oscuro' ? '#333333' : '#ffffff';

            setcookie('tema', $tema, time() + 2 * 24 * 60 * 60); // Duración de 2 días

        } else if(isset($_POST['delete_cookie'])) {

            // Si eliminamos la cookie, se reestablece el tema claro
            setcookie('tema', '', time() - 3600); // Eliminamos la cookie

            $backgroundColor = '#90EE90'; // Volvemos al fondo verde
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Tema</title>

    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="estilo.css">

    <style>

        /* Definir dinámicamente el color de fondo desde PHP */
        body {
            background-color: <?= $backgroundColor ?>;
            color: <?= $backgroundColor === '#333333' ? '#ffffff' : '#000000' ?>;
        }

    </style>

</head>
<body>

    <h1>Elige el tema de la página</h1>

    <!-- Formulario para seleccionar entre fondo claro y oscuro -->
    <form method="post">
        <button type="submit" name="theme" value="light" class="light">Fondo Claro</button>
        <button type="submit" name="theme" value="dark" class="dark">Fondo Oscuro</button>
    </form>

    <!-- Formulario para eliminar la cookie -->
    <form method="post" style="margin-top: 20px;">
        <button type="submit" name="delete_cookie">Eliminar Preferencia</button>
    </form>

</body>
</html>
