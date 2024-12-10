<?php

// Iniciamos la sesión
session_start();

// Eliminamos las variables específicas de la sesión
unset($_SESSION['nombre']);
unset($_SESSION['edad']);

// Redirigimos a la página de mostrar sesión
header('Location: mostrar_sesion.php');
exit();

?>