<?php

    /*
    AddPage() crea una nueva página en el PDF
    SetFont() define fuente, estilo y tamaño a utilizar
    Cell() permite imprimir un texto (ancho, alto, texto)
    Output() genera el archivo y le asigna un nombre. D: descarga
    */

    // Incluimos la biblioteca
    require('../../fpdf/fpdf.php');

    // Creamos el PDF
    $pdf = new FPDF();

    // Añadimos una página al PDF
    $pdf -> AddPage();

    // Establecemos la fuente del PDF
    $pdf -> SetFont('Arial','B',16);

    // Escribimos texto en el PDF
    $pdf -> Cell(40, 10, 'PDF generado con PHP y FPDF');

    // Damos un nombre al PDF y una opción de descarga
    $pdf -> Output('basico.pdf','D');

?>