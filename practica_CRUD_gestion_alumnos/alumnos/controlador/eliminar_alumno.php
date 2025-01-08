<?php

    // Incluimos la conexión
    include("../config/conexion.php");

    // Recogemos el ID del alumno desde la URL
    $id_alumno = $_GET['id_alumno'];

    // Verificar que el ID es válido
    if(!isset($id_alumno) || !is_numeric($id_alumno)){
        die("Error: ID inválido o no proporcionado");
    }

    // Preparamos la consulta
    $sql = "DELETE FROM alumnos WHERE id_alumno = ?";

    // Preparamos la sentencia
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Verificamos si se pudo preparar la sentencia
    if(!$sentencia) {
        die("Error al preparar la consulta: " . $mysqli_conexion -> error);
    }

    // Vinculamos el ID como parámetro
    $sentencia -> bind_param("i", $id_alumno);

    // Ejecutamos la consulta
    if($sentencia -> execute()) {

        // Redirigimos al listado de alumnos con un mensaje de éxito
        header("Location: ../vista/listar_alumno.php");
        exit;

    } else {

        // Mostrar un mensaje de error si no se pudo eliminar el registro
        echo "Error al eliminar el registro " . $mysqli_conexion -> error;

    }

    // Cerramos la sentencia y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>