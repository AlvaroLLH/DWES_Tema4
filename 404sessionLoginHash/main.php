<?php

    // Nos unimos a la sesión
    if(!$_SESSION) {
        session_start();
    }

    // Y comprobamos que el usuario se haya autentificado
    if(!isset($_SESSION['usuario'])) {

        // Si no se ha autenticado, redirigimos al login
        header("Location: index_.php?loginEnIndex=true");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
</head>
<body>
    
    <h1>Bienvenido <?= $_SESSION['usuario'] ?></h1>

    <h2>Listado de productos</h2>
    <ul>
        <li>Producto 1</li>
        <li>Producto 2</li>
    </ul>

    <p>Pulse <a href="logout.php">aquí</a> para salir</p>
    
</body>
</html>