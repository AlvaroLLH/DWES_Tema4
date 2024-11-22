<?php

    // Creamos, escribimos y cerramos un fichero
    $file = "ficheros/miarchivo.txt";
    $texto = "Hola, esto está escrito en el fichero";

    // Abrimos el fichero en modo escritura
    $fp = fopen($file,"w");

    // Si queremos añadir texto, debe abrirse a+
    //$fp = fopen($file, "a+");

    // Escribimos el texto en el fichero
    fwrite($fp, $texto);

    // Cerramos el fichero
    fclose($fp);

?>