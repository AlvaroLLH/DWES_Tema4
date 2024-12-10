<?php

// Arrancamos la sesión
session_start();

// Mostramos el valor de la variable
echo "El valor de la variable count es: " . $_SESSION['count'];

?>