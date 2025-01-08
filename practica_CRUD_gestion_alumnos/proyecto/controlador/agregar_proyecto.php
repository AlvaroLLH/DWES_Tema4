<?php

    // Incluimos la conexión
    include("../config/conexion.php");

    // Creamos la conexión
    $conexion = conexion();

    // Try-catch
    try {

    // Verificamos si el formulario fue enviado
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Validamos los datos recibidos del formulario
        $titulo = $_POST['titulo'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $periodo = $_POST['periodo'] ?? null;
        $curso = $_POST['curso'] ?? null;
        $fecha_presentacion = $_POST['fecha_presentacion'] ?? null;
        $nota = $_POST['nota'] ?? null;

        // Verificamos que todos los campos obligatorios estén presentes
        if (empty($titulo) || empty($descripcion) || empty($periodo) || empty($curso) || empty($fecha_presentacion) || empty($nota)) {
            die("Error: Todos los campos obligatorios deben estar completos");
        }

        // Procesamos el archivo del logotipo (imagen)
        if(isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] === UPLOAD_ERR_OK) {

            // Verificamos que el archivo sea una imagen
            $logotipo = file_get_contents($_FILES['logotipo']['tmp_name']);

        } else {
            $logotipo = null;
        }

        // Procesamos el archivo del PDF
        if(isset($_FILES['pdf_proyecto']) && $_FILES['pdf_proyecto']['error'] === UPLOAD_ERR_OK) {

            // Verificamos que el archivo sea un PDF
            if($_FILES['pdf_proyecto']['type'] !== 'application/pdf') {
                die("Error: El archivo debe ser un PDF");
            }
            $pdf = file_get_contents($_FILES['pdf_proyecto']['tmp_name']); // Convertimos el archivo en un formato apto para la BD
        } else {
            $pdf = null;
        }

    // Sentencia SQL para la inserción de datos
    $sql = "INSERT INTO proyecto (titulo, descripcion, periodo, curso, fecha_presentacion, nota, logotipo, pdf_proyecto)
    values (:titulo, :descripcion, :periodo, :curso, :fecha_presentacion, :nota, :logotipo, :pdf_proyecto)";

    // Preparamos la consulta
    $sentencia = $conexion -> prepare($sql);

    // Vinculamos parámetros usando bindParam
    $sentencia -> bindParam(":titulo", $titulo, PDO::PARAM_STR);
    $sentencia -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
    $sentencia -> bindParam(":periodo", $periodo, PDO::PARAM_STR);
    $sentencia -> bindParam(":curso", $curso, PDO::PARAM_INT);
    $sentencia -> bindParam(":fecha_presentacion", $fecha_presentacion, PDO::PARAM_STR);
    $sentencia -> bindParam(":nota", $nota, PDO::PARAM_INT);
    $sentencia -> bindParam(":logotipo", $logotipo, PDO::PARAM_LOB);
    $sentencia -> bindParam(":pdf_proyecto", $pdf, PDO::PARAM_LOB);

    // Ejecutamos la consulta
    if($sentencia -> execute()){

        // Redirigimos al listado de proyectos
        header("Location: ../vista/listar_proyecto.php");
        exit;

    // Si no hay datos, mostramos un error
        } else {
            echo "Error: No se pudo insertar el proyecto en la base de datos";
        }
    } else {
        echo "Error: El formulario no fue enviado correctamente";
    }

    // Gestionamos la excepción
    } catch (PDOException $e) {
        echo "Error de base de datos: " . $e->getMessage();

    } finally {

    // Desconectamos
    $conexion = null;

    }

?>