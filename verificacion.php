<?php
  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');


   if (isset($_POST['activar'])){
       

        include_once("Negocio/UsuarioNegocio.php");
        $activo =activarCuentaUsuario($_POST['correo'],$_POST['token']);

        
        if(!$activo){
            $error[0] = "Ha ocurrido un problema al activar la cuenta";            
        }

        if (!isset($error)) {
            
        header('Location:verificacion.php?active=true');
        }else{

        }
      
    
   
}
if(isset($_POST['login'])){
    header('Location:login.php');
}
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
    
    <?php if(isset($_GET['e']) && isset($_GET['token'])){ ?>
    <div class=" alert " role="alert"><?php echo 'Usted esta intentando registrarse con el siguiente correo: <b>'. $_GET['e']. '</b><br> Para terminar con el proceso de confirmación seleccione la opcion de activar';?></div>
    <form action= "verificacion.php" method="post">
    <div class="spassword">
            <input type="hidden" name="correo" value="<?php echo $_GET['e'] ?>">
            <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
            <input type="submit" name="activar"  value="Activar Cuenta"><br>
        </div>
    </form>
    <?php } ?>
    <br>
    <?php 
        if(isset($error)){
			foreach($error as $err){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $err?></div>
			<?php } } ?>
    <br>
    <?php if(isset($_GET['active'])&& $_GET['active']=="true"){ ?>
    <div class=" alert alert-success" role="alert"><?php echo 'Tu cuenta ha sido activada';?></div>
        <br>
        <form action="verificacion.php" method="POST">
        <div class="ssingup">
            <a href="login.php"><input type="submit" value="Iniciar Sesión" name="login"></a>
            </div>
            </form>


    <?php } ?>
    
    </div>     
       
    
</body>
</html>