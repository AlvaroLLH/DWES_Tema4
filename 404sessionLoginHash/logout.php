<?php

    // Recuperamos la información de la sesión
    session_start();

    // Eliminamos las variables de sesión
    session_unset();

    // La destruimos
    session_destroy();

    // Redirigimos al index
    header("Location: index_.php");

?>