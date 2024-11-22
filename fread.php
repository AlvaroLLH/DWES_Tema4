<?php

    // Abriendo un archivo y leyendo su contenido

    // Guardamos el archivo y lo abrimos
    $file = "miarchivo.txt";
    $fp = fopen($file,"r");

    // filesize() nos devuelve el tamaño del archivo
    $contents = fread($fp, filesize($file));
    echo $contents;

    // Cerramos la conexión con el archivo
    fclose($fp);

?>