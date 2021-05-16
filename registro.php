
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


if (isset($_POST['register_sent'])){
    foreach ($_POST as $inputs => $vars) {
if(trim($vars) == "") $error[0] = "No se han llenado todos los datos";
}
include 'Negocio/UsuarioNegocio.php';
$correcto = False;
if (!isset($error)) {
    
    $correcto = addUsuario($_POST['nombre'], $_POST['email'], $_POST['contrasena'], $_POST['contrasena2'] );
    
    
    }

    
    if ($correcto == 1 and !isset($error)) {
        login($_POST['email'],$_POST['contrasena']);
        header('Location:index.php');
        }else{
            if (isset($error)){
                
            $error[] = $correcto;
            }else{
            $error = $correcto;
        }}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <form class="center" action="registro.php" method="post">
        <h1>Registro de usuario</h1>
        <?php if(isset($error)){
			foreach($error as $err){ 
                if ($err != ''){?>
			<div class="alert alert-danger" role="alert"><?php echo $err ?></div>
			<?php } }} ?>
            
            <div class="txt_field">
                <label>Nombre</label><br>
                <input type="text" name="nombre" placeholder="Nombre">
            
            </div>
            
            <div class="txt_field">
                <label>Correo electronico</label><br>
                <input type="text" name="email" placeholder="Correo electronico">
            </div>
            
            
            <div class="txt_field">
                <label>Contraseña</label><br>
                <input type="password" name="contrasena" placeholder="Contraseña">
            </div>

            <div class="txt_field">
                <label>Repita su contraseña</label><br>
                <input type="password" name="contrasena2" placeholder="Contraseña">
            </div>

            <div class="spassword">
            <input type="submit"  value="Registrarse" name="register_sent">
            </div>
    </form>
    
</body>
</html>