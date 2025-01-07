<?php

    // Declaramos el titulo y la hoja de estilos a usar
    $titulo = "Listar Proyecto";
    $estilo = "css/estiloListar.css";

    // Incluimos el encabezado, la conexión y la biblioteca de FPDF
    include("encabezado.php");
    include("../config/conexion.php");
    require("../../../../fpdf/fpdf.php");

    // Creamos la conexión
    $conexion = conexion();

?>

<h1>Listado de Proyectos</h1>

    <!-- Try-catch -->
    <?php
    try {
        
        // Creamos la consulta
        $sql = "SELECT * FROM proyecto";

        // Preparamos la consulta
        $sentencia = $conexion -> prepare($sql);
        $sentencia -> setFetchMode(PDO::FETCH_OBJ);

        // Ejecutamos la consulta
        $sentencia -> execute();

        // Guardamos el número de filas
        $numFilas = $sentencia -> rowCount();

    ?>

    <!-- Mostramos el número de registros de la tabla -->
    <h2>El número de registros de esta tabla es: <?= $numFilas ?></h2>

    <!-- Creamos la tabla -->
    <table>
        <thead>
            <tr>
                <th>ID Proyecto</th> <!-- Mostramos el ID -->
                <th>Título</th> <!-- Mostramos el titulo -->
                <th>Descripción</th> <!-- Mostramos la descripción -->
                <th>Período</th> <!-- Mostramos el período -->
                <th>Curso</th> <!-- Mostramos el curso -->
                <th>Fecha de presentación</th> <!-- Mostramos la fecha de presentación -->
                <th>Nota</th> <!-- Mostramos la nota -->
                <th>Logotipo</th> <!-- Mostramos el logotipo -->
                <th>PDF</th> <!-- Mostramos el PDF -->
                <th>Modificar</th> <!-- Mostramos el botón de modificar -->
                <th>Eliminar</th> <!-- Mostramos el botón de borrar -->
            </tr>
        </thead>
        <tbody>

            <?php

            // Si hay datos en el array asociativo, los mostramos
            if($numFilas > 0){
                while($proyecto = $sentencia -> fetch()) {
                    echo "<tr>";
                    echo "<td>" . $proyecto -> id_proyecto . "</td>";
                    echo "<td>" . $proyecto -> titulo . "</td>";
                    echo "<td>" . $proyecto -> descripcion . "</td>";
                    echo "<td>" . $proyecto -> periodo . "</td>";
                    echo "<td>" . $proyecto -> curso . "</td>";
                    echo "<td>" . $proyecto -> fecha_presentacion . "</td>";
                    echo "<td>" . $proyecto -> nota . "</td>";

                    // Mostramos el logotipo como una imagen
                    if(!empty($proyecto -> logotipo)){

                        // Pasamos a base64
                        $imagenBase64 = base64_encode($proyecto -> logotipo);

                        // Mostramos el logotipo
                        echo "<td><img src='data:image/jpeg;base64,$imagenBase64' alt='Logotipo' width='100'></td>";

                    } else {
                        echo "<td>Sin logotipo</td>";
                    }

                    // Generamos el PDF
                    $pdf = new FPDF();

                    // Creamos una nueva página
                    $pdf->AddPage();

                    // Establecemos la fuente
                    $pdf->SetFont("Arial","B",16);

                    // Mostramos el título del proyecto
                    $pdf->Cell(40,10,'Proyecto: ' . $proyecto->titulo);

                    // Salto de línea
                    $pdf->Ln(10);

                    // Establecemos la fuente
                    $pdf->SetFont('Arial','',12);

                    // Mostramos los datos del registro
                    $pdf -> Image('ficheros/lupa.png', 160, 8, 35, 38, "PNG");
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, 'Descripcion: ' . $proyecto->descripcion);
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, 'Periodo: ' . $proyecto->periodo);
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, 'Curso: ' . $proyecto->curso);
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, 'Fecha de presentacion: ' . $proyecto->fecha_presentacion);
                    $pdf->Ln(10);
                    $pdf->MultiCell(0, 10, 'Nota: ' . $proyecto->nota);

                    // Creamos el nombre del archivo PDF
                    $nombrePDF = "pdf_proyectos_" . $proyecto->id_proyecto . "_" . $proyecto->titulo . "_AlvaroLlamas_" .
                    $proyecto->curso . "_" . $proyecto->periodo . "_" . $proyecto->fecha_presentacion . ".pdf";

                    // Ruta donde se guardará el PDF
                    $rutaPDF = "../pdf/" . $nombrePDF;

                    // Guardamos el PDF en la carpeta "pdf"
                    $pdf->Output('F', $rutaPDF);

                    // Generamos el enlace al PDF
                    echo "<td><a href='$rutaPDF' target='_blank'>Ver PDF</a></td>";

                    // Botón de modificar
                    echo "<td><a href='formulario_modificar_proyecto.php?id_proyecto=" . $proyecto -> id_proyecto . "' class='btn-modificar'>Modificar</td>";

                    // Botón de eliminar
                    echo "<td><a href='../controlador/eliminar_alumno.php?id_proyecto=" . $proyecto -> id_proyecto . "' class='btn-eliminar'>Eliminar</td>";
                    echo "</tr>";
                }
                
            } else {

                // Si no hay registros, mostramos un mensaje
                echo "<tr><td colspan='11'>No hay registros disponibles.</td></tr>";
            }

            ?>

        </tbody>
    </table>

    <!-- Botón para agregar un registro -->
    <br><a href='formulario_agregar_proyecto.php?id_proyecto=<?php echo $proyecto -> id_proyecto; ?>' class="btn-agregar">Agregar</a>

    <?php

    // Gestionamos la excepción
    } catch (PDOException $e) {
        echo $e -> getMessage();
    }

    // Incluimos el pie de página
    include("pie.php");

    ?>