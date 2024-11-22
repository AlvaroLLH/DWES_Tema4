<?php

    // Guardamos el contenido del fichero como una cadena
    $contenido = file_get_contents("ficheros/fichero_ejemplo.txt");

    // Mostramos el contenido del fichero
    echo "Contenido del fichero: $contenido<br>";

    // Escribimos datos en el fichero
    $res = file_put_contents("ficheros/fichero_salida.txt", "Fichero creado con file_put_contents");

    // Comprobamos que los datos se han insertado correctamente
    if($res) {
        echo "Fichero creado con éxito";
    } else {
        echo "Error al crear el fichero";
    }

?>