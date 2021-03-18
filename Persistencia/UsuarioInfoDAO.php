<?php 



function obtenerInfoUsuarios()
{
include_once "Entidades/UsuarioInfo.php";
include("Conexion.php");

 $queryUsuarioInfo = "SELECT id, edad, direccion, numero_mascotas, telefono, id_usuario, cedula, celular FROM emp_usuario_info";

  // Ejecutamos el query
  $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryUsuarioInfo) or trigger_error("El query de login de usuario falló");

  $usuariosInfo = [];


if (mysqli_num_rows($resQueryUsuarioInfo)) { 

while ($infoData = mysqli_fetch_assoc($resQueryUsuarioInfo)){
    $info = new UsuarioInfo();
	$info->id =  $infoData['id'];
	$info->edad =  $infoData['edad'];
	$info->direccion=  $infoData['direccion'];
	$info->numeroMascotas =  $infoData['numero_mascotas'];
	$info->telefono =  $infoData['telefono'];
	$info->idUsuario =  $infoData['id_usuario'];
	$info->cedula =  $infoData['cedula'];
	$info->celular =  $infoData['celular'];
	
	

	array_push($usuariosInfo, $info);
} 
}

 return $usuariosInfo;

}