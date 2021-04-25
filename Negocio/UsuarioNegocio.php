<?php


function addUsuario($nombre, $email, $contrasenia, $contrasenia2){
	$correcto = false;
	//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
	include_once "Persistencia/UsuarioDAO.php";

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error[]="No se ha introducido un email valido";
		}
	if ($contrasenia != $contrasenia2) {
		$error[] = "Los contraseñas no son coincidentes";
		}
	if(verificarEmail($email)){
		$error[] = "El email ya esta siendo utilizado";
		
	}
	if (!isset($error)) {
	$correcto = agregarUsuario($nombre, $email, $contrasenia);
	return $correcto;
		
	}

}


function editUsuario ($id, $nombre, $correo, $contrasenia, $rol){



	//Validamos si las variables  vienen vacias
	if($id=="" || $nombre =="" || $correo=="" || $contrasenia=="" || $rol=="" ){
		echo 'Falta(n) completar campo(s)';

	}else{
			//Se manda a llamar el metodo de la persistencia para editar la info del usuario en la BD
			include_once "Persistencia/UsuarioDAO.php";
		 return	editarUsuario($id, $nombre, $correo, $contrasenia, $rol);
	}
}


function deleteUsuario ($id){

	//Validamos si las variables  vienen vacias
	if($id=="" ){
		echo 'Falta seleccionar id';


	}else{
			//Se manda a llamar el metodo de la persistencia para eliminar al usuario a la BD
			include_once "Persistencia/UsuarioDAO.php";
			eliminarUsuario($id);
	}
}


function getUsuarios(){

	include_once "Persistencia/UsuarioDAO.php";
	$usuarios = obtenerUsuarios();

	return $usuarios;
	}


function login($correo, $contrasenia){
		//Validamos si las variables  vienen vacias
	if( trim($correo)=="" || trim($contrasenia)=="" ){

	}else{
		include_once("Persistencia/UsuarioDAO.php");
		
		$permitido = iniciarSesion($correo, $contrasenia);

return $permitido;
}
}






?>
