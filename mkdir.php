<?php

    // mkdir() sirve para crear un directorio

    // Guardamos la ruta del directorio donde crearemos la carpeta
    chdir('C:\Users\alvaro.llahue\Documents\xampp\htdocs');

    // Guardamos el nuevo directorio
    $directorio = "nuevo";

    // Creamos el directorio
    mkdir($directorio);

?>