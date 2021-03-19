<?php 
include_once "Entidades/Usuario.php";
include_once "Persistencia/UsuarioDAO.php";

$usu = obtenerUsuarios();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<h1><?php echo $usu[0]->nombre ?></h1>
	
</body>
</html>