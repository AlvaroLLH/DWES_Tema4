<?php

    // Incluimos la conexión
    include("../config/conexion.php");

    // Recogemos los datos enviados por el formulario
    $id_tutor = $_POST["id_tutor"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $tipo_usu = $_POST["tipo_usu"];
    $baja = $_POST["baja"];
    $activar = $_POST["activar"];

    // Consulta para actualizar el registro
    $sql = "UPDATE tutor SET login = ?, password = ?, correo = ?, nombre = ?, apellidos = ?, tipo_usu = ?, baja = ?, activar = ? WHERE id_alumno = ?";

    // Preparamos la consulta
    $sentencia = $mysqli_conexion -> prepare($sql);

    // Vinculamos el tipo de dato a las variables
    $sentencia -> bind_param("sssssiiii", $login, $password, $correo, $nombre, $apellidos, $tipo_usu, $baja, $activar, $id_alumno);

    // Ejecutamos la consulta y verificamos si se actualizó correctamente
    if($sentencia -> execute()) {

        // Redirigimos al listado de alumnos
        header("Location: ../vista/listar_tutor.php");
        exit;

    } else {

        // Mostramos un mensaje de error si no se pudo actualizar
        echo "Error al actualizar el tutor " . $mysqli_conexion -> error;
    }

    // Cerramos la consulta y desconectamos
    $sentencia -> close();
    $mysqli_conexion -> close();

?>