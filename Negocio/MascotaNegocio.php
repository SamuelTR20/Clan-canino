<?php 

function getMascotas(){

	include_once "Persistencia/MascotaDAO.php";
	
	$mascotas = obtenerMascotas();
	return $mascotas;
	}

	function getMascota($idMascota){
		//Validamos si las variables  vienen vacias
	
		include_once("Persistencia/MascotaDAO.php");
		
		$mascota = obtenerMascota($idMascota);

        return $mascota;
	}


function addMascota($idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto){

	if ($idRefugio=="" || $nombre=="" || $especie=="" || $edad=="" || $sexo=="" || $observaciones=="" || $estado =="" || $historia==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/MascotaDAO.php";
		$agregado=	agregarMascota($idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto);
	
	return $agregado;
	}
}


function editMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto){

	if ($id =="" || $idRefugio=="" || $nombre=="" || $especie=="" || $edad=="" || $sexo=="" || $observaciones=="" || $estado =="" || $historia==""){
				
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/MascotaDAO.php";
			editarMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto);
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
