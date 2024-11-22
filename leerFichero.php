<?php

    // Abrimos el fichero en solo lectura
    $fp = fopen("ficheros/miarchivo.txt","r");

    // Si se encuentra el archivo, le recorremos carácter a carácter
    if($fp === FALSE) {
        echo "No existe el fichero o no se pudo leer<br>";
        
    } else {
        while(!feof($fp)) {

            // Guardamos los caracteres del archivo y los mostramos
            $car = fgetc( $fp );
            echo $car;
        }
    }

    // Cerramos el archivo
    fclose($fp);

?>