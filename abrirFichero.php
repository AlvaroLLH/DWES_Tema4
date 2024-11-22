<?php

    // Guardamos el nombre del archivo
    $nombreArchivo = 'ficheros/miarchivo.txt';

    // Abrimos el archivo
    $archivo = fopen($nombreArchivo,'r');

    // Comprobamos que el archivo se abrió correctamente
    if($archivo) {
        
        echo "El archivo se abrió correctamente";

        // Cerramos el archivo
        fclose($archivo);

    } else {
        echo "No se pudo abrir el archivo";
    }

?>