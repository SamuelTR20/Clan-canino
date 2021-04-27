<?php 
if (!isset($_SESSION)) {
	session_start();
  
  }



function obtenerRefugios(){
include_once "Entidades/Refugio.php";
include("Conexion.php");
$connLocalhost = conexion();

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
$connLocalhost->close();

 return $refugios;

}

function obtenerRefugio(){

	include_once("Conexion.php");
	$connLocalhost = conexion();
	include_once "Entidades/Usuario.php";

	$queryRefugio = "SELECT nombre, ciudad, telefono, direccion, descripcion FROM emp_refugio where id=16";

  // Ejecutamos el query
  	$resQueryRefugio = mysqli_query($connLocalhost, $queryRefugio) or trigger_error("El query de obtener refugio falló");

	  if (mysqli_num_rows($resQueryRefugio) == 1) {
		// Hacemos un fetch del recordset
		$refugioData = mysqli_fetch_assoc($resQueryRefugio);
		if (!isset($_SESSION)) {
		  session_start();
		}
		// Definimos variables de sesion en $_SESSION
		$_SESSION['refugioNombre'] = $refugioData['nombre'];
		$_SESSION['refugioCiudad'] = $refugioData['ciudad'];
		$_SESSION['refugioTelefono'] = $refugioData['telefono'];
		$_SESSION['refugioDireccion'] = $refugioData['direccion'];
		$_SESSION['refugioDescripcion'] = $refugioData['descripcion'];
	
		$permitido = true;
	
		$connLocalhost->close();
		return $permitido;
		
	
	
	  } else {
		$connLocalhost->close();
		return $permitido;
	  }


}

function editarRefugio($nombre, $ciudad, $telefono, $direccion, $descripcion){
	include_once("Conexion.php");
	$connLocalhost = conexion();
  
	include_once "Entidades/Refugio.php";
  
	$queryEditRefugio = sprintf(
	  "UPDATE  emp_refugio SET nombre = '%s', ciudad = '%s', telefono = '%s', direccion = '%s', descripcion = '%s' WHERE id = 16 ",
	  mysqli_real_escape_string($connLocalhost, trim($nombre)),
	  mysqli_real_escape_string($connLocalhost, trim($ciudad)),
	  mysqli_real_escape_string($connLocalhost, trim($telefono)),
	  mysqli_real_escape_string($connLocalhost, trim($direccion)),
	  mysqli_real_escape_string($connLocalhost, trim($descripcion))
  
  
  
	);
  
  
	// Ejecutamos el query en la BD
	$resQueryRefugio = mysqli_query($connLocalhost, $queryEditRefugio) or trigger_error("El query de inserción de usuarios falló");
  
  
	if ($resQueryRefugio) {
	  $connLocalhost->close();
  
	  if (!isset($_SESSION)) {
		session_start();
	  }
	
	  // Definimos variables de sesion en $_SESSION

	
	  	$_SESSION['refugioNombre'] = $nombre;
	  	$_SESSION['refugioCiudad'] = $ciudad;
	  	$_SESSION['refugiotelefono'] =$telefono;
	  	$_SESSION['refugioDireccion'] = $direccion;
    	$_SESSION['refugioDescripcion'] = $descripcion;
	  return true;
	} else {
	  $connLocalhost->close();
	  return false;
	}
  
  }

?>