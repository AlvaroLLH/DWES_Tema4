<?php

    /*
    Crea un script que genere un pdf con encabezado y pie que incluya una imagen, un enlace y texto de un archivo (listado de las personas o alumnos). Mejora: cada registro en una página
    */

    // Incluimos la biblioteca de FPDF
    require('../../../fpdf/fpdf.php');

    // Creamos una clase PDF que hereda de FPDF
    class PDF extends FPDF {

        // Cabecera de página
        function Header() {

            // Mostramos una imagen
            $this -> Image('../ficheros/chill-guy.jpg', 10, 8, 35, 38, "JPG");

            // Establecemos la fuente
            $this -> SetFont('Arial', 'B', 15);

            // Movemos a la derecha
            $this -> Cell(80);

            // Título del documento
            $this -> Cell(60, 10, 'Listado de Personas', 1, 0, 'C');

            // Salto de línea
            $this -> Ln(20);

        }

        // Pie de página
        function Footer() {

            // Posición del pie de página
            $this -> SetY(-15);

            // Fuente
            $this -> SetFont('Arial', 'I', 8);

            // Mostramos el número de la página
            $this -> Cell(0, 10, 'Pagina ' . $this -> PageNo(), 0, 0, 'C');
        }

        // Función para agregar el texto del archivo al PDF
        function TituloArchivo($num, $label) {

            // Posicionamiento
            $this -> SetY(55);

            // Fuente
            $this -> SetFont('Arial', '', 12);

            // Color de fondo
            $this -> SetFillColor(200, 220, 255);

            // Título
            $this -> Cell(0, 6, "$label", 0, 1, 'L', true);

            // Salto de línea
            $this -> Ln(4);
        }

        // Función CuerpoArchivo
        function CuerpoArchivo($fichero) {

            // Leemos el fichero
            $f = fopen($fichero, 'r');
            $txt = fread($f, filesize($fichero));
            fclose($f);

            // Fuente
            $this -> SetFont('Times', '', 12);

            // Imprimimos el texto justificado
            $this -> MultiCell(0, 5, $txt);

            // Salto de línea
            $this -> Ln();

        }

        // Función para imprimir el archivo
        function ImprimirArchivo($num, $titulo, $fichero) {

            // Agregamos una página
            $this -> AddPage();

            // Llamamos a la función TituloArchivo
            $this -> TituloArchivo($num, $titulo);

            // Llamamos a la función CuerpoArchivo
            $this -> CuerpoArchivo($fichero);

        }
    }

    // Creación del objeto de la clase heredada
    $pdf = new PDF();

    // Creamos el título
    $titulo = 'Listado de Personas';

    // Mostramos el título
    $pdf -> SetTitle($titulo);

    // Posicionamiento
    $pdf -> SetY(65);

    // Mostramos el fichero
    $pdf -> ImprimirArchivo(1, 'Personas', '../ficheros/listadoPersonas.txt');

    // Salida del fichero
    $pdf -> Output();

?>