<?php

// Guardamos el servidor al que queremos conectar
$servidor='mysql:dbname=pruebas; host=localhost';

// Función que crea una conexión
function conexion($servidor)
{

    // Guardamos el usuario y la contraseña
    $usuario = 'root';
    $pw = '';

    // Try-catch
    try {

        // Creamos la conexión
        $conexion = new PDO($servidor, $usuario, $pw);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Devolvemos la conexión
        return $conexion;

        // Gestionamos la excepción
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }
    echo "Conectado!";
}
?>