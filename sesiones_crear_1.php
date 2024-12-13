<?php

    /*
    Crea la sesión (session_start()) y si no existe  una variable de sesión 'count', la crea
    con valor 0. Si existe, le suma 1.

    Enlaza a sesiones_unirse_2.php. que se une  a la sesión (session_start()) y muestra el 
    valor de la variable $_SESSION['count']
    */

// Arrancamos la sesión
session_start();

// Creamos una variable de sesión si no existe y si existe, le sumamos 1
if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;

} else {
    $_SESSION['count']++;
}

// Mostramos el contador
echo "Hola " . $_SESSION['count'];

// Enlazamos a la 2º parte del código
echo "<br><a href='sesiones_unirse_2.php'>Me uno a la sesión</br>";

?>