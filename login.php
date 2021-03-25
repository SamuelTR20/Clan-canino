<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <form class="center" action="post">
        <h1>Inicio de sesion</h1>

            <div class="txt_field">
                <label>Usuario</label><br>
                <input type="text" name="usuario" placeholder="Correo elecontrico o usuario">
            </div>

            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>

            <div class="password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="spassword">
            <input type="submit"  value="Iniciar sesión"><br>
            </div>
            <h2>o</h2>
            <div class="ssingup">
            <input type="submit" value="Registrate">
            </div>
    </form>
    
</body>
</html>