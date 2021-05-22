<?php 

function getTotalMascotas($busqueda){

	include_once "Persistencia/MascotaDAO.php";
	
	$totalMascotas = obtenerTotalMasscotas($busqueda);
	
	return $totalMascotas;
	}

function getMascotas($busqueda, $mostrar, $maximo, $estado){
	include_once "Persistencia/MascotaDAO.php";
	
	$mascotas = obtenerMascotas($busqueda, $mostrar, $maximo, $estado);
	return $mascotas;
}
function getMascotasApp(){

	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/MascotaDAO.php";

	return obtenerMascotasApp();

}

	function getMascota($idMascota){
		//Validamos si las variables  vienen vacias
	
		include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/MascotaDAO.php";
		
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
		$permitido	= editarMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto);

		return $permitido;
	}
}


function deleteMascota($id){

	//Validamos si las variables  vienen vacias
	if($id=="" ){
		echo 'Falta seleccionar id';


	}else{
			//Se manda a llamar el metodo de la persistencia para eliminar al usuario a la BD
			include_once "Persistencia/MascotaDAO.php";
			$eliminar = eliminarMascota($id);
			return $eliminar;
	}
}

function deleteImage($id){
	include_once "Persistencia/MascotaDAO.php";
	$ruta = obtenerImagenMascota($id);

	if($ruta != false){
	unlink($ruta);
	}

}

?>
