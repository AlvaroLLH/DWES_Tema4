<?php

    // Script que inserta dos usuarios (uno de cada tipo) en la tabla users con password encriptada

    // Parámetros de conexión a la BD
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pruebas";

    // Creamos la conexión
    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Comprobamos que conectamos
    if($conexion->connect_error) {
        die("Conexión fallida: ". $conexion->connect_error);
    }

    // Datos de los usuarios a insertar
    $usuarios = [
        ['usuario' => 'admin', 'password' => 'admin123', 'tipo_usu' => 1], // Administrador
        ['usuario' => 'usuario', 'password' => 'user123', 'tipo_usu' => 2] // Usuario normal
    ];

    // Insertamos los usuarios con contraseñas encriptadas
    foreach($usuarios as $usuario) {

        // Encriptamos la contraseña
        $password_hash = password_hash($usuario['password'], PASSWORD_DEFAULT);

        // Insertamos el usuario en la BD
        $sentencia = $conexion->prepare("INSERT INTO users (usuario, password, tipo_usu) VALUES (?, ?, ?)");
        $sentencia->bind_param("ssi", $usuario['usuario'], $password_hash, $usuario['tipo_usu']);

        if($sentencia->execute()) {
            echo "Usuario {$usuario['usuario']} insertado correctamente";
        } else {
            echo "Error insertando el usuario {$usuario['usuario']}: " . $sentencia->error . "<br>";
        }
    }

    // Desconectamos
    $conexion->close();
    
?>