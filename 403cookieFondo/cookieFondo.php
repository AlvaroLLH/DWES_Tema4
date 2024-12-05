<?php

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Color de Fondo</title>

    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="estilo.css">

    <style>

        /* Definimos dinámicamente el color de fondo desde PHP */
        body {
            background-color: <?= $backgroundColor ?>;
            color: <?= $backgroundColor === '#333333' ? '#ffffff' : '#000000' ?>;
        }

    </style>

</head>
<body>

    <h1>Elige el tema de la página</h1>

    <!-- Formulario para seleccionar el tema claro o oscuro -->
    <form method="post">
        <button type="submit" name="tema" value="claro" class="claro">Fondo Claro</button>
        <button type="submit" name="tema" value="oscuro" class="oscuro">Fondo Oscuro</button>
    </form>

    <!-- Formulario para eliminar la cookie -->
    <form method="post" style="margin-top: 20px;">
        <button type="submit" name="delete_cookie">Eliminar Cookie</button>
    </form>
    
</body>
</html>