<?php

    // Incluimos la conexión a la base de datos
    include("../config/conexion.php");

    // Recogemos los datos enviados por el formulario
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $curso = $_POST['curso'];

    // Verificar que los datos obligatorios estén presentes
    if(!isset($dni, $nombre, $apellido1, $apellido2, $email, $telefono, $curso)) {
        die("Error: Todos los campos son obligatorios");
    }

    // Creamos la consulta para insertar los datos
    $sql = "INSERT INTO alumnos (dni, nombre, apellido1, apellido2, email, telefono, curso) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Verificamos si se pudo preparar la consulta
    if(!$sentencia){
        die("Error al preparar la consulta " . $mysqli_conexion -> error);
    }

    // Vinculamos los parámetros
    $sentencia -> bind_param("sssssii", $dni, $nombre, $apellido1, $apellido2, $email, $telefono, $curso);

    // Ejecutamos la consulta
    if($sentencia -> execute()){

        // Redirigimos al listado de alumnos
        header("Location: ../vista/listar_alumno.php");
        exit;

    } else {

        // Mostramos un mensaje de error si no se pudo insertar el registro
        echo "Error al insertar el registro " . $mysqli_conexion -> error;
    }

    // Cerramos la sentencia y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>