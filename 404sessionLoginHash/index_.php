<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Login</title>
</head>
<body>
    
    <!-- Creamos el formulario -->
    <form action="login.php" method="post">
        <fieldset>

            <legend>Login</legend>

            <?php

                // Si hay error al hacer login
                if(isset($error)) {

                    // Mostramos el error
                    echo $error;
                }

            ?>

            <?php

                // Si se intentó entrar en main, lo mostramos
                if(isset($_GET['loginEnIndex'])) {
                    echo "Haz login para entrar en esta página<br/>";
                }
                
            ?>

            <br/>
                <!-- Campo para el usuario -->
                <label for="usuario">Usuario:</label><br/>
                <input type="text" name="inputUsuario" id="usuario" maxlength="50"/><br/>

                <!-- Campo para la contraseña -->
                <label for="password">Contraseña:</label><br/>
                <input type="password" name="inputPassword" id="password" maxlength="50"/><br/>
            <br/>

                <!-- Botón de envio -->
                <input type="submit" name="enviar" value="Enviar"/>
                
        </fieldset>
    </form>

</body>
</html>