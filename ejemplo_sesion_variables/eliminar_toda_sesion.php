<?php

// Iniciamos la sesión
session_start();

// Eliminamos todas las variables de sesión
session_unset();

// Destruimos la sesión
session_destroy();

// Redirigimos a la página de mostrar sesión
header('Location: mostrar_sesion.php');
exit();

?>