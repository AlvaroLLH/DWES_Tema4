<?php

    /*
    Para destruir una cookie se usa setcookie() con una fecha límite anterior
    a la actual o con una fecha del pasado
    */

    function borrarCookie($cookie) {

        // Si la cookie existe
        if(!isset($_COOKIE[$cookie])) {

        // Devolvemos la cookie eliminada
        return setcookie($cookie,"", time() - 3600 * 24);

        } else {
            return "La cookie $cookie no existe";
        }
    }
    
?>