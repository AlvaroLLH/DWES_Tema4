<?php

// Escribe el restulado de la consulta de listar las personas en un fichero listadoPersonas.txt

// Incluimos la conexión
include("conexionPDO.php");

// Creamos la conexión
$conexion = conexion($servidor);

// Guardamos la carpeta
$carpeta = "../ficheros/";

// Verifica si la carpeta existe, si no, la crea
if (!is_dir($carpeta)) {
    mkdir($carpeta, 0777, true); // Crea la carpeta con permisos 0777
}

// Guardamos y abrimos el archivo
$nombreArchivo = $carpeta . "/listadoPersonas.txt";
$fp = fopen($nombreArchivo, 'a+');

// Si el archivo se ha abierto correctamente
if ($fp) {

    // Try-catch
    try {

        // Creamos la consulta
        $sql = "select * from persona";

        // Preparamos la sentencia
        $sentencia = $conexion->prepare($sql);

        // Guardamos la consulta en un array asociativo
        $sentencia->setFetchMode(PDO::FETCH_OBJ);

        // Preparamos la sentencia
        $sentencia->execute();

        // Mientras que haya registros, los mostramos
        while ($fila = $sentencia->fetch()) {

            // Guardamos los datos en un array asociativo
            $linea = "ID: $fila->id_persona, Nombre: $fila->nombre, Apellidos: $fila->apellidos, Telefono: $fila->telefono, Edad: $fila->edad\n";

            // Escribimos en el archivo fila a fila
            fwrite($fp, $linea);
        }

        // Gestionamos la excepción
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // Si el archivo no se abre, mensaje de error
} else {
    echo "Error, el archivo $nombreArchivo no se ha abierto<br>";
}

// Cerramos el archivo
fclose($fp);

// Abrimos el fichero
$fp = fopen($nombreArchivo, "r");

// Comprobamos que el tamaño sea mayor que 0
if(filesize($nombreArchivo) > 0) {

    // Leemos el fichero
    $contents = fread($fp, filesize($nombreArchivo));

} else {
    $contents = "";
}

?>

<h1 style="text-align:center;">Listado de Personas</h1>

<link rel="stylesheet" href="estilo.css">

<!-- Creamos la tabla -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Edad</th>
        </tr>
    </thead>
    <tbody>


        <?php

        // Dividimos el contenido en líneas
        $lineas = array_filter(array_map('trim', explode("\n", $contents)));

        // Recorremos el array de líneas
        foreach ($lineas as $linea) {

            // Ignoramos líneas vacías
            if (!empty($linea)) {

                // Dividimos la línea en partes utilizando la coma como delimitador
                $campos = explode(", ", $linea);

                if(count($campos) === 5) {

                // Extraemos los valores eliminando la etiqueta ("ID:", "Nombre:", etc.)
                $id = str_replace("ID: ", "", trim($campos[0])); //
                $nombre = str_replace("Nombre: ", "", trim($campos[1]));
                $apellidos = str_replace("Apellidos: ", "", trim($campos[2]));
                $telefono = str_replace("Teléfono: ", "", trim($campos[3]));
                $edad = str_replace("Edad: ", "", trim($campos[4]));

        ?>
                <tr>
                    <td><?php echo $id ?></td> <!-- Campo para el ID -->
                    <td><?php echo $nombre ?></td> <!-- Campo para el nombre -->
                    <td><?php echo $apellidos ?></td> <!-- Campo para los apellidos -->
                    <td><?php echo $telefono ?></td> <!-- Campo para el teléfono -->
                    <td><?php echo $edad ?></td> <!-- Campo para la edad -->
                </tr>
        <?php
        }
        }
        }
        ?>

    </tbody>

    <?php

    // Cerramos la conexión
    $conexion = null;

    ?>