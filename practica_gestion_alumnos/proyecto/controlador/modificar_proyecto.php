<?php

// Incluimos la conexión
include("../config/conexion.php");

// Creamos la conexión
$conexion = conexion();

// Verificamos si los datos se enviaron por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recogemos los datos enviados por el formulario
    $id_proyecto = $_POST['id_proyecto'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $periodo = $_POST['periodo'];
    $curso = $_POST['curso'];
    $fecha = $_POST['fecha_presentacion'];
    $nota = $_POST['nota'];

    // Inicializamos las variables para archivos
    $logotipo = null;
    $pdf_proyecto = null;

    // Verificamos si se subió un nuevo logotipo
    if (!empty($_FILES['logotipo']['tmp_name'])) {
        $logotipo = file_get_contents($_FILES['logotipo']['tmp_name']);
    }

    // Verificamos si se subió un nuevo PDF
    if (!empty($_FILES['pdf_proyecto']['tmp_name'])) {
        $pdf_proyecto = file_get_contents($_FILES['pdf_proyecto']['tmp_name']);
    }

    try {
        // Construimos la consulta dinámica
        $sql = "UPDATE proyecto 
                SET titulo = :titulo, 
                    descripcion = :descripcion, 
                    periodo = :periodo, 
                    curso = :curso, 
                    fecha_presentacion = :fecha_presentacion, 
                    nota = :nota";

        // Solo añadimos logotipo si se subió
        if ($logotipo !== null) {
            $sql .= ", logotipo = :logotipo";
        }

        // Solo añadimos PDF si se subió
        if ($pdf_proyecto !== null) {
            $sql .= ", pdf_proyecto = :pdf_proyecto";
        }

        // Añadimos la condición WHERE
        $sql .= " WHERE id_proyecto = :id_proyecto";

        // Preparamos la consulta
        $consultaUpdate = $conexion->prepare($sql);

        // Asignamos valores a los parámetros
        $consultaUpdate->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":periodo", $periodo, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":curso", $curso, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":fecha_presentacion", $fecha, PDO::PARAM_STR);
        $consultaUpdate->bindParam(":nota", $nota, PDO::PARAM_INT);
        $consultaUpdate->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);

        // Solo vinculamos logotipo si se subió
        if ($logotipo !== null) {
            $consultaUpdate->bindParam(":logotipo", $logotipo, PDO::PARAM_LOB);
        }

        // Solo vinculamos PDF si se subió
        if ($pdf_proyecto !== null) {
            $consultaUpdate->bindParam(":pdf_proyecto", $pdf_proyecto, PDO::PARAM_LOB);
        }

        // Ejecutamos la consulta
        if ($consultaUpdate->execute()) {
            // Redirigimos al listado de proyectos
            header("Location: ../vista/listar_proyecto.php");
            exit;
        } else {
            echo "Error al actualizar el registro.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerramos la conexión
        $conexion = null;
    }
} else {
    echo "Método no permitido.";
}

?>