<?php

    // Ruta del archivo
    $filePath = "ficheros/matriz.txt";

    // Nos aseguramos de que el archivo existe
    if(file_exists($filePath)) {

        // Abrimos el archivo para la lectura
        $file = fopen($filePath,"r");

        // Si se encuentra el fichero, lo leemos
        if($file) {
            echo "Lectura fila por fila";

            // Mientras no sea el final del fichero
            while(!feof($file)) {

                // Leemos cada fila con fscanf
                fscanf($file,"%d %d %d", $num1, $num2, $num3);
                echo "<br> $num1, $num2, $num3 ";
            }

            // Cerramos el archivo
            fclose($file);

        } else {
            echo "No se pudo abrir el archivo";
        }
        
    } else {
        echo "Archivo no encontrado";
    }

?>