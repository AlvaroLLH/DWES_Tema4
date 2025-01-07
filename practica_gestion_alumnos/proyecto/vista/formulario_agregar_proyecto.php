<?php

    // Declaramos el título y la hoja de estilos
    $titulo = "Agregar Proyecto";
    $estilo = "css/estiloFormulario.css";

    // Incluimos el encabezado
    include("encabezado.php");

?>

<!-- Mostramos el título -->
<h1><?= $titulo ?></h1>

<link rel="stylesheet" href="<?= $estilo ?>">

<!-- Creamos el formulario -->
<form action="../controlador/agregar_proyecto.php" method="POST" enctype="multipart/form-data">

    <!-- Campo para el título -->
    <label for="titulo">
        <p>Título:</p><input type="text" name="titulo" id="titulo" required>
    </label>

    <!-- Campo para la descripción -->
    <label for="descripcion">
        <p>Descripción:</p><input type="text" name="descripcion" id="descripcion" required>
    </label>

    <!-- Campo para el período -->
    <label for="periodo">
        <p>Período:</p><input type="text" name="periodo" id="periodo" min="0" max="99999999" required>
    </label>

    <!-- Campo para el curso -->
    <label for="curso">
        <p>Curso:</p><input type="number" name="curso" id="curso" min="0" max="99999999" required>
    </label>

    <!-- Campo para la fecha de presentación -->
    <label for="fecha_presentacion">
        <p>Fecha de presentación:</p><input type="date" name="fecha_presentacion" id="fecha_presentacion" required>
    </label>

    <!-- Campo para la nota -->
    <label for="nota">
        <p>Nota:</p><input type="number" name="nota" id="nota" min="0" max="99999999" required>
    </label>

    <!-- Campo para el logotipo -->
    <label for="logotipo">
        <p>Logotipo:</p><input type="file" name="logotipo" id="logotipo" accept="image/*" required>
    </label>

    

    <!-- Botón para enviar -->
    <label for="enviar">
        <p><input type="submit" value="Enviar"></p>
    </label>

</form>

<?php

// Incluimos el pie de página
include("pie.php");

?>