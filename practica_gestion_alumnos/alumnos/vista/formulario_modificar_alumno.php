<?php

    $titulo = "Formulario Modificar";
    include("encabezado.php");

    // Incluimos la conexión
    include("../config/conexion.php");

    // Guardamos el ID recibido por URL
    $id_alumno = $_GET["id_alumno"];

    // Mensaje si no se introduce un ID
    if(!isset($id_alumno) || !is_numeric($id_alumno)) {
        die("No se ha introducido un ID o es inválido");
    }

    // Creamos la consulta
    $sql = "SELECT * FROM alumnos WHERE id_alumno = ?";

    // Creamos la sentencia
    $sentencia = $mysqli_conexion -> prepare($sql);
    $sentencia -> bind_param("i", $id_alumno); // Vinculamos el ID como un entero

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
</head>
<body>

    <h1>Formulario Modificar</h1>
    <form action="../controlador/modificar_alumno.php" method="POST">

    <!-- Campo oculto para enviar el ID del registro -->
     <input type="hidden" name="id_alumno" value="<?php echo($registro['id_alumno'])?>">

        <!-- Campo para modificar el DNI -->
        <div>
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo ($registro['dni']); ?>" required>
        </div>

        <!-- Campo para modificar el nombre -->
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo ($registro['nombre']); ?>" required>
        </div>

        <!-- Campo para modificar el 1º apellido -->
        <div>
            <label for="apellido1">1º Apellido</label>
            <input type="text" id="apellido1" name="apellido1" value="<?php echo ($registro['apellido1']); ?>" required>
        </div>

        <!-- Campo para modificar el 2º apellido -->
        <div>
            <label for="apellido2">2º Apellido:</label>
            <input type="text" id="apellido2" name="apellido2" value="<?php echo ($registro['apellido2']); ?>" required>
        </div>

        <!-- Campo para modificar el email -->
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo ($registro['email']); ?>" required>
        </div>

        <!-- Campo para modificar el teléfono -->
        <div>
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo ($registro['telefono']); ?>" required>
        </div>

        <!-- Campo para modificar el curso -->
        <div>
            <label for="curso">Curso:</label>
            <input type="number" id="curso" name="curso" value="<?php echo ($registro['curso']); ?>" required>
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