<?php

function getTramites($busqueda, $maximo, $mostrar){

	include_once "Persistencia/TramiteDAO.php";
	$tramites = obtenerTramites($busqueda, $maximo, $mostrar);

	return $tramites;
	}

function getTramitePorId($id){

		include_once "Persistencia/TramiteDAO.php";
		
		$tramite = obtenerTramiteId($id);
		
		return $tramite;
		}

function addTramite($idUsuario, $idMascota, $estado){

	if ($idUsuario=="" || $idMascota=="" || $estado==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/TramiteDAO.php";
		return	agregarTramite($idUsuario, $idMascota, $estado);
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


function cambiarEstado($id, $idMascota, $estado){

	include_once "Persistencia/TramiteDAO.php";
	 
	$correcto = editarEstado($id, $estado);
	if($correcto == 1 and $estado == 'aceptado'){
		cancelarTramites($idMascota);
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


function obtenerTotalTramite($busqueda){

	include_once "Persistencia/TramiteDAO.php";
	
	$totalTramites = obtenerTotalTram($busqueda);
	
	return $totalTramites;
	}


?>
