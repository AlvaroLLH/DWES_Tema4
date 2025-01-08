<?php

    $titulo = "Formulario Modificar";
    include("encabezado.php");

    // Incluimos la conexión
    include("../config/conexion.php");

    // Guardamos el ID recibido por URL
    $id_tutor = $_GET["id_tutor"];

    // Mensaje si no se introduce un ID
    if(!isset($id_tutor) || !is_numeric($id_tutor)) {
        die("No se ha introducido un ID o es inválido");
    }

    // Creamos la consulta
    $sql = "SELECT * FROM tutor WHERE id_tutor = ?";

    // Creamos la sentencia
    $sentencia = $mysqli_conexion -> prepare($sql);
    $sentencia -> bind_param("i", $id_tutor); // Vinculamos el ID como un entero

    // Ejecutamos la sentencia
    $sentencia -> execute();

    // Guardamos el resultado como un objeto
    $resultado = $sentencia -> get_result();

    // Almacenamos el registro como un array asociativo
    $registro = $resultado -> fetch_assoc();

    // Cerramos la consulta
    $sentencia -> close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloFormulario.css">
</head>
<body>

    <h1>Formulario Modificar</h1>
    <form action="../controlador/modificar_tutor.php" method="POST">

    <!-- Campo oculto para enviar el ID del registro -->
     <input type="hidden" name="id_tutor" value="<?php echo($registro['id_tutor'])?>">

        <!-- Campo para modificar el login -->
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" value="<?php echo ($registro['login']); ?>" required>
        </div>

        <!-- Campo para modificar la password -->
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo ($registro['password']); ?>" required>
        </div>

        <!-- Campo para modificar el correo -->
        <div>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="<?php echo ($registro['correo']); ?>" required>
        </div>

        <!-- Campo para modificar el nombre -->
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo ($registro['nombre']); ?>" required>
        </div>

        <!-- Campo para modificar los apellidos -->
        <div>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo ($registro['apellidos']); ?>" required>
        </div>

        <!-- Campo para modificar la baja -->
        <div>
        <label for="baja">Baja:</label>
        <select id="baja" name="baja" required>
            <option value="0" <?php echo ($registro['baja'] == 0) ? 'selected' : ''; ?>>Activo</option>
            <option value="1" <?php echo ($registro['baja'] == 1) ? 'selected' : ''; ?>>De baja</option>
        </select>
        </div>

        <!-- Botón para confirmar la modificación -->
        <input type="submit" value="Modificar">

    </form>

    <?php

    // Incluimos el pie de la página
    include("pie.php");

    // Cerramos la conexión
    $mysqli_conexion -> close();

    ?>

</body>
</html>