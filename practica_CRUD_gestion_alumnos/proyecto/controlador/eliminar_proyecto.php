<?php

    // Conectamos a la base de datos
    include("../config/conexion.php");

    // Creamos la conexión
    $conexion = conexion();

    // Pedimos el ID por URL
    $id_proyecto = $_GET["id_proyecto"];

    // Comprobamos que se haya pasado un ID
    if(!isset($id)){
        exit("No hay ID");
    }

    // Hacemos la consulta
    $consultaDelete = $conexion -> prepare("DELETE FROM proyecto WHERE id_proyecto = ?");

    // Vinculamos el parámetro del ID
    $consultaDelete -> bindParam("i", $id_proyecto);

    // Ejecutamos la consulta
    $consultaDelete -> execute();

    // Redirigimos al listado de proyectos
    header("Location: ../vista/listar_proyecto.php");

    // Desconectamos
    $conexion = null;
    
?>