<?php


function addUsuario($nombre, $correo, $contrasenia, $rol){

	//Validamos si las variables  vienen vacias
	if($nombre =="" || $correo=="" || $contrasenia=="" || $rol=="" ){

		echo 'Falta(n) completar campo(s)';
	}else{
			//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
			include_once "Persistencia/UsuarioDAO.php";
			agregarUsuario($nombre, $correo, $contrasenia, $rol);
	}
}


function editUsuario ($id, $nombre, $correo, $contrasenia, $rol){

	//Validamos si las variables  vienen vacias
	if($id=="" || $nombre =="" || $correo=="" || $contrasenia=="" || $rol=="" ){
		echo 'Falta(n) completar campo(s)';

	}else{
			//Se manda a llamar el metodo de la persistencia para editar la info del usuario en la BD
			include_once "Persistencia/UsuarioDAO.php";
			editarUsuario($id, $nombre, $correo, $contrasenia, $rol);
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
	if( $correo=="" || $contrasenia=="" ){
		echo 'Falta(n) completar campo(s)';

	}else{
		include_once "Persistencia/UsuarioDAO.php";
		iniciarSesion($correo, $contrasenia);

}






?>
