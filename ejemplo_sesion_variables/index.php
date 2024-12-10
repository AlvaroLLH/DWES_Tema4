<?php

    /*
    Crea un ejemplo donde variables $nombre y $edad se almacenen en la variable de sesión. Enlaza a otra 
    página donde muestre el valor del array $_SESSION y el id. Crea un enlace donde se elimine la variable de sesión 
    y la muestra y posteriormente elimina la sesión y lo muestra (print_r($_SESSION)).
    */

    // Arrancamos la sesión
    session_start();

    // Declaración de variables
    $nombre = "José";
    $edad = "48";

    // Almacenar las variables en la sesión
    $_SESSION['nombre'] = $nombre;
    $_SESSION['edad'] = $edad;

    // Redirigimos a la página donde mostramos los valores
    header('Location: mostrar_sesion.php');
    exit();

?>