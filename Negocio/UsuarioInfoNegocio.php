<?php

function addInfo($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular){
	$correcto = false;
	//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
	include_once "Persistencia/UsuarioInfoDAO.php";
	
	
	if (!isset($error)) {
	$correcto = agregarInfoUsuario($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular);
	return $correcto;
		
	}

}

function infoById($idUsuario){
	
	//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
	include_once "Persistencia/UsuarioInfoDAO.php";

	$info = obtenerInfoUsuariosPorId($idUsuario);
	return $info;
		

}


function UpdateInfo($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular){
	$correcto = false;
	//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
	include_once "Persistencia/UsuarioInfoDAO.php";

	if (!isset($error)) {
	$correcto = editarUsuarioInfo($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular);
	return $correcto;
		
	}

}


function obtenerInfoCompleta($idUsuario){
	include_once "Persistencia/UsuarioInfoDAO.php";
	$info = obtenerInfoCompletaUsuario($idUsuario);
	return $info;
}

?>