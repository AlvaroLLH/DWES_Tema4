<?php

    /*
    Buscamos la cookie "visitas", si no existe se crea con valor 1, si existe se suma 1
    */

    // Incluimos la función para borrar la cookie
    include("cookieBorrar.php");

    // Si se hace clic en el botón de borrar la cookie
    if (isset($_POST['borrar_cookie'])) {

        // Llamamos a la función para borrar la cookie
        borrarCookie('visitas');

    } else {

    // Si la cookie no existe:
    if(!isset($_COOKIE['visitas'])){

        // Creamos la cookie 'visitas'
        setcookie('visitas','1', time() + 3600 * 24);
        echo "Bienvenido por primera vez";

    } else {

        // Guardamos el número de visitas
        $visitas = (int) $_COOKIE['visitas'];

        // Aumentamos el número de visitas en 1
        $visitas++;

        // Mostramos la cookie
        setcookie('visitas', $visitas, time() + 3600 * 24);
        echo "Bienvenido por $visitas vez";
    }
}

?>

<!-- Formulario para borrar la cookie -->
<form method="post">
    <button type="submit" name="borrar_cookie">Eliminar Cookie</button>
</form>