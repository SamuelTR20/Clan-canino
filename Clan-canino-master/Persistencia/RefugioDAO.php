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
	$ref->id =  $refData['id'];
	$ref->nombre =  $refData['nombre'];
	$ref->ciudad=  $refData['ciudad'];
	$ref->telefono =  $refData['telefono'];
	$ref->direccion =  $refData['direccion'];
	$ref->descripcion =  $refData['descripcion'];
	
	

	array_push($refugios, $ref);
} 
}

 return $refugios;

}