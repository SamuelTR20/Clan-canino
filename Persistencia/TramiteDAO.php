<?php 



function obtenerTramites()
{
include_once "Entidades/Tramite.php";
include("Conexion.php");

 $queryTramites = "SELECT id, id_usuario, id_tramota, estado, fecha_solicitud FROM emp_tramite";

  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryTramites) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
    $tram = new Tramite();
	$tram->id =  $tramData['id'];
	$tram->idUsuario =  $tramData['id_usuario'];
	$tram->idMascota=  $tramData['id_mascota'];
	$tram->estado =  $tramData['estado'];
	$tram->fechaSolicitud =  $tramData['fecha_solicitud'];
	
	

	array_push($Tramites, $tram);
} 
}

 return $Tramites;

}