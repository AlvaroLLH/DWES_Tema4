    <?php $titulo = "Listar Tutor"; 
    include("encabezado.php");
    
    // Incluimos la conexión a la base de datos
    include("../config/conexion.php"); 
    
    // Consulta SQL para seleccionar todos los registros de la tabla "alumnos"
    $sql = "SELECT * FROM tutor";

    // Almacenar los resultados en un array asociativo
    $resultados = $mysqli_conexion -> query($sql);

    // Mostramos un mensaje en caso de error al realizar la consulta
    if(!$resultados){
        die("Error al realizar la consulta: " . $mysqli_conexion -> error);
    }

    ?>

    <link rel="stylesheet" href="css/estiloTabla.css">

    <div>
    <a href="../../login/cerrar_sesion.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    </div>

    <h1>Listado de Tutores</h1>

    <!-- Tabla HTML para mostrar los registros -->
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Password</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Tipo de Usuario</th>
                <th>Baja</th>
                <th>Activado</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>

            <?php

            // Verificamos si hay filas para mostrar
            if($resultados -> num_rows > 0){
                while($fila = $resultados -> fetch_assoc()){

                    echo "<tr>";
                    echo "<td>" . ($fila['login']) . "</td>"; // Login
                    echo "<td>" . ($fila['password']) . "</td>"; // Password
                    echo "<td>" . ($fila['correo']) . "</td>"; // Correo
                    echo "<td>" . ($fila['nombre']) . "</td>"; // Nombre
                    echo "<td>" . ($fila['apellidos']) . "</td>"; // Apellidos
                    echo "<td>" . ($fila['tipo_usu']) . "</td>"; // Tipo de usuario
                    echo "<td>" . ($fila['baja']) . "</td>"; // Baja
                    echo "<td>" . ($fila['activar']) . "</td>"; // Activar

                    // Botón de modificar como enlace
                    echo "<td><a href='formulario_modificar_tutor.php?id_tutor=" . $fila['id_tutor'] . "' class='btn-modificar'>Modificar</td>";
                    echo "<td><a href='../controlador/eliminar_tutor.php?id_tutor=" . $fila['id_tutor'] . "' class='btn-eliminar'>Eliminar</td>";
                    echo "</tr>";
                }
                
            } else {

                // Si no hay registros, mostramos un mensaje
                echo "<tr><td colspan='4'>No hay registros disponibles.</td></tr>";
            }

            ?>

        </tbody>
    </table>

    <!-- Botón de agregar un registro -->
    <br><a href='formulario_agregar_tutor.php?id_tutor=<?php echo $fila['id_tutor']; ?>' class='btn-agregar'>Agregar</a>

    <?php include("pie.php"); ?>