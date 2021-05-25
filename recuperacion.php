<?php
  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');


   if (isset($_POST['correo_sent'])){
       

        include_once("Negocio/UsuarioNegocio.php");
        $token = "us".rand(0,100000);
        $editado = updateToken($_POST['correo'],$token);
        $enviado =recuperarContra($_POST['correo'],$token);

        
        if(!$enviado && !$editado){
            $error[0] = "Ha ocurrido un problema al enviar el correo de recuperación";            
        }

        if (!isset($error)) {
            
        header('Location:recuperacion.php?sent=true');
        }else{

        }
      
    
   
}

if (isset($_POST['editContra'])){
    foreach ($_POST as $inputs => $vars) {
if(trim($vars) == "") $error[0] = "No se han llenado todos los datos";
}
if($_POST['contrasena'] != $_POST['contrasena2']){
    $error= "Las contraseñas no coinciden";
}
include 'Negocio/UsuarioNegocio.php';
$correcto = False;
if (!isset($error)) {
    
    $correcto = updateContra($_POST['contrasena'], $_POST['email'], $_POST['token'] );
    
    
    }

    
    if ($correcto == 1 and !isset($error)) {
        login($_POST['email'],$_POST['contrasena']);
        header('Location:index.php');
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
    <?php if(isset($_GET['sent'])&& $_GET['sent']=="true"){ ?>
    <div class=" alert alert-success" role="alert"><?php echo 'Se te ha enviado un correo electronico con instrucciones para recuperar tu contraseña';?></div>
    <?php } 
        if(isset($error)){
			foreach($error as $err){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $err?></div>
			<?php } } ?>

    <?php if(!isset($_GET['e']) && !isset($_GET['token'])){ ?>
    <form action= "recuperacion.php" method="post">
    <h1>Recuperar Contraseña</h1>
    <p>Introduzca la direccion de correo electronico asociada a su cuenta.</p>
    <div class="txt_field">
                <label>Correo Electronico</label><br>
                <input type="text" name="correo" placeholder="Correo elecontrico">
            </div>
    <div class="spassword">
                <input type="submit" name="correo_sent"  value="Enviar Correo"><br>
        </div>
    </form>


    <?php } ?>

    <br>
    <?php if(isset($_GET['e']) && isset($_GET['token'])){ ?>
    <form action= "recuperacion.php" method="post">
    <h1>Recuperar Contraseña</h1>
    <p>Introduzca la nueva contraseña para su cuenta.</p>
            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>

            <div class="txt_field">
                <label>Repita su contraseña</label><br>
                <input type="password" name="contrasena2" placeholder="Contraseña">
            </div>
            
            <div class="spassword">
            <input type="hidden" name="email" value="<?php echo $_GET['e'] ?>">
            <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
            <input type="submit" name="editContra"  value="Cambiar Contraseña"><br>
                </div>
    </form>


    <?php } ?>


    
    <br>
    
    
    </div>     
       
    
</body>
</html>