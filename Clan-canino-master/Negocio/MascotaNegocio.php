<?php 

function getMascotas(){

	include_once "Persistencia/MascotaDAO.php";
	$mascotas = obtenerMascotas();

	return $mascotas;
	}


function addMascota($idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia){

	if ($idRefugio=="" || $nombre=="" || $especie=="" || $edad=="" || $sexo=="" || $observaciones=="" || $estado =="" || $historia==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/MascotaDAO.php";
			agregarMascota($idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia);
	}
}


function editMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia){

	if ($id =="" || $idRefugio=="" || $nombre=="" || $especie=="" || $edad=="" || $sexo=="" || $observaciones=="" || $estado =="" || $historia==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/MascotaDAO.php";
			editarMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia);
	}
}


function deleteMascota ($id){

	//Validamos si las variables  vienen vacias
	if($id=="" ){
		echo 'Falta seleccionar id';


	}else{
			//Se manda a llamar el metodo de la persistencia para eliminar al usuario a la BD
			include_once "Persistencia/MascotaDAO.php";
			eliminarMascota($id);
	}
}

?>
