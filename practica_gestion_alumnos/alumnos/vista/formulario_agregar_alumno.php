    <?php $titulo = "formulario_agregar_alumno"; 
    include("encabezado.php"); ?>

    <!-- Formulario que permite agregar un nuevo registro a nuestra tabla, que llamara a agregar_alumno -->

    <h3>Formulario Agregar</h3>

    <form action="../controlador/agregar_alumno.php" method="POST">

    <!-- Pedimos el DNI -->
    <p><label for="dni">DNI</label>
    <input type="text" name="dni" id="dni" required></p>

    <!-- Pedimos el nombre -->
    <p><label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required></p>

    <!-- Pedimos el 1º apellido -->
    <p><label for="apellido1">1º Apellido</label>
    <input type="text" name="apellido1" id="apellido1" required></p>

    <!-- Pedimos el 2º apellido -->
    <p><label for="apellido2">2º Apellido</label>
    <input type="text" name="apellido2" id="apellido2" required></p>

    <!-- Pedimos el email -->
    <p><label for="email">Email</label>
    <input type="email" name="email" id="email" required></p>

    <!-- Pedimos el teléfono -->
    <p><label for="telefono">Teléfono</label>
    <input type="tel" name="telefono" id="telefono" required></p>

    <!-- Pedimos el curso -->
    <p><label for="curso">Curso</label>
    <input type="number" name="curso" id="curso" required></p>

    <!-- Boton de envío -->
    <p><input type="submit" value="Agregar alumno"></p>

    <?php include("pie.php"); ?>