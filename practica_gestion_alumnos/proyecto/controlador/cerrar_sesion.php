<?php

// Iniciamos la sesión
session_start();

// Destruimos todas las variables de sesión
session_unset();

// Destruimos la sesión
session_destroy();

// Redirigimos a la página de login
header("Location: ../vista/login.php");
exit;

?>