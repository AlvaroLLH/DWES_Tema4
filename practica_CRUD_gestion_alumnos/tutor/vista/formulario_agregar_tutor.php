    <?php $titulo = "formulario_agregar_tutor"; 
    include("encabezado.php"); ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estiloFormulario.css">
    </head>
    <body>
        
    <!-- Formulario que permite agregar un nuevo registro a nuestra tabla, que llamara a agregar_alumno -->

    <h3>Formulario Agregar</h3>

    <form action="../controlador/agregar_tutor.php" method="POST">

    <!-- Pedimos el login -->
    <p><label for="login">Login</label>
    <input type="text" name="login" id="login" required></p>

    <!-- Pedimos la password -->
    <p><label for="password">Password</label>
    <input type="password" name="password" id="password" required></p>

    <!-- Pedimos el correo -->
    <p><label for="correo">Correo</label>
    <input type="email" name="correo" id="correo" required></p>

    <!-- Pedimos el nombre -->
    <p><label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required></p>

    <!-- Pedimos los apellidos -->
    <p><label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" required></p>

    <!-- Pedimos el tipo de usuario -->
    <p>
        <label for="tipo_usu">Tipo de Usuario</label>
        <select name="tipo_usu" id="tipo_usu" required>
            <option value="1">Administrador</option>
            <option value="2">Tutor</option>
        </select>
    </p>

    <!-- Pedimos la baja -->
    <p>
        <label for="baja">Baja</label>
        <select name="baja" id="baja" required>
            <option value="0">Activo</option>
            <option value="1">De baja</option>
        </select>
    </p>

    <!-- Pedimos si el usuario está activado o no -->
    <p>
        <label for="activar">Activado</label>
        <select name="activar" id="activar" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </p>

    <!-- Boton de envío -->
    <p><input type="submit" value="Agregar tutor"></p>

    </body>
    </html>

    <?php include("pie.php"); ?>