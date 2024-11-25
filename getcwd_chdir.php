<?php

    /*
    getcwd() obtiene el directorio actual
    chdir() cambia el directorio actual al directorio $directory
    */
    
    // Directorio: /directorio/actual
    echo getcwd() . "\n";

    // Directorio: /directorio/actual/carpeta
    chdir('carpeta');
    echo getcwd() . "\n";

    // Directorio: c:/xampp/htdocs
    chdir('c:/xampp/htdocs');
    echo getcwd() . "\n";

?>