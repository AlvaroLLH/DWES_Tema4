<?php

// Declaramos el título y la hoja de estilos
$titulo = "Actualizar Proyecto";
$estilo = "css/estiloFormulario.css";

// Incluimos el encabezado y la conexión
include("encabezado.php");
include("../config/conexion.php");

?>

<!-- Mostramos el título -->
<h1><?= $titulo ?></h1>

<link rel="stylesheet" href="<?= $estilo ?>">

<?php

// Creamos la conexión
$conexion = conexion();

// Pedimos el ID por URL
$id_proyecto = $_GET['id_proyecto'];

try {
    
    // Creamos la consulta
    $sql = "SELECT * FROM proyecto WHERE id_proyecto = :id_proyecto";

    // Preparamos la consulta
    $sentencia = $conexion->prepare($sql);

    // Asignamos el valor al parámetro id_proyecto
    $sentencia->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);

    // Ejecutamos la consulta
    $sentencia->execute();

    // Guardamos los datos del registro en un array asociativo
    $proyecto = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra ningún proyecto con ese ID, mostramos un mensaje de error
    if (!$proyecto) {
        exit("No se encontró ningún proyecto con ese ID.");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!-- Creamos el formulario para modificar el proyecto -->
<form action="../controlador/modificar_proyecto.php" method="POST" enctype="multipart/form-data">

    <!-- Campo oculto para el ID -->
    <input type="hidden" name="id_proyecto" value="<?= $proyecto['id_proyecto'] ?>">

    <!-- Campo para el título -->
    <label for="titulo">
        <p>Título:</p>
        <input type="text" name="titulo" value="<?= htmlspecialchars($proyecto['titulo']) ?>" required>
    </label>

    <!-- Campo para la descripción -->
    <label for="descripcion">
        <p>Descripción:</p>
        <input type="text" name="descripcion" value="<?= htmlspecialchars($proyecto['descripcion']) ?>" required>
    </label>

    <!-- Campo para el período -->
    <label for="periodo">
        <p>Período:</p>
        <input type="text" name="periodo" value="<?= $proyecto['periodo'] ?>" required>
    </label>

    <!-- Campo para el curso -->
    <label for="curso">
        <p>Curso:</p>
        <input type="number" name="curso" value="<?= $proyecto['curso'] ?>" required>
    </label>

    <!-- Campo para la fecha de presentación -->
    <label for="fecha_presentacion">
        <p>Fecha de presentación:</p>
        <input type="date" name="fecha_presentacion" value="<?= $proyecto['fecha_presentacion'] ?>" required>
    </label>

    <!-- Campo para la nota -->
    <label for="nota">
        <p>Nota:</p>
        <input type="number" name="nota" value="<?= $proyecto['nota'] ?>" required>
    </label>

    <!-- Campo para el logotipo -->
    <label for="logotipo">
        <p>Logotipo:</p>
        <input type="file" name="logotipo" id="logotipo" accept="image/*">
    </label>

    

    <!-- Botón de envío -->
    <label for="enviar">
        <p><input type="submit" value="Actualizar"></p>
    </label>

</form>

<?php

// Desconectamos
$conexion = null;

?>