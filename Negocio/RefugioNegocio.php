<?php 

function getRefugio(){
    include_once("Persistencia/RefugioDAO.php");
    obtenerRefugio();
}

function editRefugio ($nombre, $ciudad, $telefono, $direccion, $descripcion){



	//Validamos si las variables  vienen vacias
	if($nombre=="" || $ciudad =="" || $telefono=="" || $direccion=="" || $descripcion=="" ){
		echo 'Falta(n) completar campo(s)';

	}else{
			//Se manda a llamar el metodo de la persistencia para editar la info del usuario en la BD
			include_once "Persistencia/RefugioDAO.php";
		 return	editarRefugio($nombre, $ciudad, $telefono, $direccion, $descripcion);
	}
}

?>