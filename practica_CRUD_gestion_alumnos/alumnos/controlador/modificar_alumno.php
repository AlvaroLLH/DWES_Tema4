<?php

    // Incluimos la conexión
    include("../config/conexion.php");

    // Recogemos los datos enviados por el formulario
    $id_alumno = $_POST["id_alumno"];
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $curso = $_POST["curso"];

    // Consulta para actualizar el registro
    $sql = "UPDATE alumnos SET dni = ?, nombre = ?, apellido1 = ?, apellido2 = ?, email = ?, telefono = ?, curso = ? WHERE id_alumno = ?";

    // Preparamos la consulta
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Vinculamos el tipo de dato a las variables
    $sentencia -> bind_param("sssssiii", $dni, $nombre, $apellido1, $apellido2, $email, $telefono, $curso, $id_alumno);

    // Ejecutamos la consulta y verificamos si se actualizó correctamente
    if($sentencia -> execute()) {

        // Redirigimos al listado de alumnos
        header("Location: ../vista/listar_alumno.php");
        exit;

    } else {

        // Mostramos un mensaje de error si no se pudo actualizar
        echo "Error al actualizar el registro " . $mysqli_conexion -> error;
    }

    // Cerramos la consulta y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>