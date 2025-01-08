<?php

    // Incluimos la conexión a la base de datos
    include("../config/conexion.php");

    // Recogemos los datos enviados por el formulario
    $login = $_POST['login'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $tipo_usu = $_POST['tipo_usu'];
    $baja = $_POST['baja'];
    $activar = $_POST['activar'];

    // Verificar que los datos obligatorios estén presentes
    if(!isset($login, $password, $correo, $nombre, $apellidos, $tipo_usu, $baja, $activar)) {
        die("Error: Todos los campos son obligatorios");
    }

    // Creamos la consulta para insertar los datos
    $sql = "INSERT INTO tutor (login, password, correo, nombre, apellidos, tipo_usu, baja, activar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Verificamos si se pudo preparar la consulta
    if(!$sentencia){
        die("Error al preparar la consulta " . $mysqli_conexion -> error);
    }

    // Vinculamos los parámetros
    $sentencia -> bind_param("sssssiii", $login, $password, $correo, $nombre, $apellidos, $tipo_usu, $baja, $activar);

    // Ejecutamos la consulta
    if($sentencia -> execute()){

        // Redirigimos al listado de alumnos
        header("Location: ../vista/listar_tutor.php");
        exit;

    } else {

        // Mostramos un mensaje de error si no se pudo insertar el registro
        echo "Error al insertar el tutor " . $mysqli_conexion -> error;
    }

    // Cerramos la sentencia y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>