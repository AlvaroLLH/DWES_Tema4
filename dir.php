<?php

    /*
    opendir() abre un gestor de directorio para ser usado en llamadas posteriores.
    readdir() lee una entrada desde un gestor de directorio abierto por opendir().
    closedir() cierra un gestor de directorio abierto.
    */

    // Contenido del directorio
    chdir('C:\Users\alvaro.llahue\Documents\xampp\htdocs');

    // Guardamos el directorio
    $directorio = "misPHP";

    // Abrimos el gestor de directorio
    if($gestor = opendir($directorio)) {

        // Mostramos el gestor de directorio y las entradas que tiene
        echo "Gestor de directorio: " . $gestor . "\n<br>";
        echo "Entradas:\n<br>";

        // Iteramos sobre el directorio
        while(false !== ($entrada = readdir($gestor))) {
            echo $entrada . "\n<br>";
        }

        // Cerramos el gestor de directorio
        closedir($gestor);

    }

?>