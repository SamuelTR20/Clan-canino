<?php

function getTramites(){

	include_once "Persistencia/TramiteDAO.php";
	$tramites = obtenerTramites();

	return $tramites;
	}


function addTramite($idUsuario, $idMascota, $estado, $rol){

	if ($idUsuario=="" || $idMascota=="" || $estado=="" || $rol==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/TramiteDAO.php";
			agregarTramite($idUsuario, $idMascota, $estado, $rol);
	}
}


function editTramite($id, $idUsuario, $idMascota, $estado){

	if ($idUsuario=="" || $idMascota=="" || $estado=="" || $id==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/TramiteDAO.php";
			editarTramite($id, $idUsuario, $idMascota, $estado );
	}
}






function deleteTramite ($id){

	//Validamos si las variables  vienen vacias
	if($id=="" ){
		echo 'Falta seleccionar id';


	}else{
			//Se manda a llamar el metodo de la persistencia para eliminar al usuario a la BD
			include_once "Persistencia/TramiteDAO.php";
			eliminarTramite($id);
	}
}
?>
