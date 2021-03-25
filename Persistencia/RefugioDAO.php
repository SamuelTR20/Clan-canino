<?php 



function obtenerRefugios()
{
include_once "Entidades/Refugio.php";
include("Conexion.php");

 $queryRefugios = "SELECT id, nombre, ciudad, telefono, direccion, descripcion FROM emp_refugio";

  // Ejecutamos el query
  $resQueryRefugios = mysqli_query($connLocalhost, $queryRefugios) or trigger_error("El query de login de usuario falló");

  $refugios = [];


if (mysqli_num_rows($resQueryRefugios)) { 

while ($refData = mysqli_fetch_assoc($resQueryRefugios)){
    $ref = new Refugio();
	$ref->setId =  $refData['id'];
	$ref->setNombre =  $refData['nombre'];
	$ref->setCiudad=  $refData['ciudad'];
	$ref->setTelefono =  $refData['telefono'];
	$ref->setDireccion =  $refData['direccion'];
	$ref->setDescripcion =  $refData['descripcion'];
	
	

	array_push($refugios, $ref);
} 
}

 return $refugios;

}