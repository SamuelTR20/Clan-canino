<?php
  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');
}

    if (isset($_POST['login_sent'])){
          foreach ($_POST as $inputs => $vars) {
      if(trim($vars) == "") $error[0] = "No se han llenado todos los datos";
        }
        $permitido = false;

        include_once("Negocio/UsuarioNegocio.php");
        if (!isset($error)) {
        $permitido = login($_POST['correo'],$_POST['contrasenia']);
        
    }
        
        if(!$permitido){
            $error[0] = "El conjunto de usuario y contraseña no son correctas";            
        }

        if (!isset($error)) {
            
        header('Location:index.php');
        }else{

        }
    } elseif(isset($_POST['register'])){
        header('Location:registro.php');
    }
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/Normalize.css">
</head>
<body>
    <div class="center">
    
    <form  action="login.php" method="post">
        <h1>Inicio de sesión</h1>

        <?php if(isset($_GET['confirmation'])&& $_GET['confirmation']=="sent"){ ?>
        <div class=" alert alert-success" role="alert"><?php echo 'Se te ha enviado un correo para activar tu cuenta';?></div>
        <br>
        <?php }?>

        <?php if(isset($_GET['loggedOff']) ){
            ?>
            <div class=" alert alert-success" role="alert"><?php echo 'Has cerrado sesión, ¡vuelve pronto!';?></div>
        <?php }
        if(isset($error)){
			foreach($error as $err){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $err?></div>
			<?php } } ?>
            <div class="txt_field">
                <label>Correo Electronico</label><br>
                <input type="text" name="correo" placeholder="Correo elecontrico">
            </div>

            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasenia" placeholder="Contraseña">
            </div>

            <div class="password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="spassword">
            <input type="submit" name="login_sent"  value="Iniciar sesión"><br>
            </div>
            <h2>o</h2>

            <div class="ssingup">
            <a href="registro.php"><input type="submit" value="Registro" name="register"></a>
            </div>
            </form> 
            </div>     
       
    
</body>
</html>