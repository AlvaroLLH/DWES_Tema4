<?php

    // Incluimos la conexión
    include("../config/conexion.php");

    // Recogemos el ID del tutor desde la URL
    $id_tutor = $_GET['id_tutor'];

    // Verificar que el ID es válido
    if(!isset($id_tutor) || !is_numeric($id_tutor)){
        die("Error: ID inválido o no proporcionado");
    }

    // Preparamos la consulta
    $sql = "DELETE FROM tutor WHERE id_tutor = ?";

    // Preparamos la sentencia
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Verificamos si se pudo preparar la sentencia
    if(!$sentencia) {
        die("Error al preparar la consulta: " . $mysqli_conexion -> error);
    }

    // Vinculamos el ID como parámetro
    $sentencia -> bind_param("i", $id_tutor);

    // Ejecutamos la consulta
    if($sentencia -> execute()) {

        // Redirigimos al listado de alumnos con un mensaje de éxito
        header("Location: ../vista/listar_tutor.php");
        exit;

    } else {

        // Mostrar un mensaje de error si no se pudo eliminar el registro
        echo "Error al eliminar el tutor " . $mysqli_conexion -> error;

    }

    // Cerramos la sentencia y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>