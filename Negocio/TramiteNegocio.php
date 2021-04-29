<?php

function getTramites($busqueda){

	include_once "Persistencia/TramiteDAO.php";
	$tramites = obtenerTramites($busqueda);

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
	editarEstado($id, $idMascota, $estado);
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
