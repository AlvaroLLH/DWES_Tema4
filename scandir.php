<?php

    /*
    scandir() devuelve un array con los archivos y directorios que
    se encuentran en $directory
    */

    // Array de archivos y directorios
    chdir('C:\Users\alvaro.llahue\Documents\xampp\htdocs');

    // Guardamos el directorio
    $directorio = "misPHP";

    // Creamos el array desde el directorio indicado
    $archivos = scandir($directorio, 1);

    // Mostramos el array de archivos y directorios
    print_r($archivos);

?>