
<?php
  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
    if(isset($_SESSION['userId'])) header('Location: index.php');
}

    if (isset($_POST['login_sent'])){
          foreach ($_POST as $calzon => $caca) {
      if($caca == "") $error[] = "La caja $calzon es obligatoria";
        }


        include_once("Negocio/UsuarioNegocio.php");

        login($_POST['correo'],$_POST['contrasena']);

        header('Location:index.php');

    }
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <form class="center" action="login.php" method="post">
        <h1>Inicio de sesion</h1>

            <div class="txt_field">
                <label>Correo Electronico</label><br>
                <input type="text" name="correo" placeholder="Correo elecontrico">
            </div>

            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>

            <div class="password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="spassword">
            <input type="submit" name="login_sent"  value="Iniciar sesión"><br>
            </div>
            <h2>o</h2>
            <div class="ssingup">
            <input type="submit" value="Registrate">
            </div>
    </form>
    
</body>
</html>