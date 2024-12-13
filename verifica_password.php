<?php

    // Creamos la contraseña
    $pwd = 12345;

    // Guardamos la contraseña en la BD
    $cadena_hash = password_hash($pwd, PASSWORD_DEFAULT);

    // Verificamos que la contraseña de usuario es la de la BD
    if(password_verify($pwd, $cadena_hash)) {
        echo "La contraseña es correcta. Has entrado";
    }

?>