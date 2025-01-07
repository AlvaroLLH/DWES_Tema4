<?php

    // Función que devuelve la conexión
    function conexion(){

    // Guardamos los datos para conectarnos a la BD
    $servidor = 'mysql:dbname=gestion_alumnos;host=localhost';
    $usuario = 'root';
    $pw = '';

    // Try-catch
    try {

        /*
        PDO::ATTR_ERRMODE indicándole a PHP que queremos un reporte de errores.
        PDO::ERRMODE_EXCEPTION con este atributo obligamos a que lance excepciones.
        */

        // Creamos la conexión y conectamos
        $conexion = new PDO($servidor, $usuario, $pw);
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Devolvemos la conexión
        return $conexion;

    // En caso de error, gestionamos la excepción
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e -> getMessage();
    }

    // Mensaje de éxito
    echo "Conectado!";

    }

?>