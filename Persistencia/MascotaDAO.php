<?php 



function obtenerMascotas()
{
include_once "Entidades/Mascota.php";
include_once("Conexion.php");
$connLocalhost = conexion();

 $queryMascotas = "SELECT id, id_refugio, nombre, edad, sexo, historia, foto, estado, observaciones,especie FROM emp_mascota";

  // Ejecutamos el query
  $resQueryMascotas = mysqli_query($connLocalhost, $queryMascotas) or trigger_error("El query de login de usuario falló");

  $Mascotas = [];

  

if (mysqli_num_rows($resQueryMascotas)) { 

while ($mascData = mysqli_fetch_assoc($resQueryMascotas)){
  $masc = new Mascota();
	$masc->setId($mascData['id']);
	$masc->setNombre($mascData['nombre']);
	$masc->setIdRefugio($mascData['id_refugio']);
	$masc->setEdad($mascData['edad']);
	$masc->setSexo($mascData['sexo']);
	$masc->setHistoria($mascData['historia']);
	$masc->setFoto($mascData['foto']);
	$masc->setEstado($mascData['estado']);
	$masc->setObservaciones($mascData['observaciones']);
	$masc->setEspecie($mascData['especie']);

  
	array_push($Mascotas, $masc);
} 

}

$connLocalhost->close();
 return $Mascotas;

}

function agregarMascota($idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia, $foto)
{
include_once "Entidades/Mascota.php";
include_once("Conexion.php");
$connLocalhost = conexion();

$queryInsertMascota = sprintf(
      "INSERT INTO emp_mascota (id_refugio, nombre, especie, edad, sexo, observaciones, estado, historia, foto) VALUES ('%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost, trim($idRefugio)),
      mysqli_real_escape_string($connLocalhost, trim($nombre)),
      mysqli_real_escape_string($connLocalhost, trim($especie)),
      mysqli_real_escape_string($connLocalhost, trim($edad)),
      mysqli_real_escape_string($connLocalhost, trim($sexo)),
      mysqli_real_escape_string($connLocalhost, trim($observaciones)),
      mysqli_real_escape_string($connLocalhost, trim($estado)),
      mysqli_real_escape_string($connLocalhost, trim($historia)),
      mysqli_real_escape_string($connLocalhost, trim($foto))

    );

    // Ejecutamos el query en la BD
    $resQueryMascota = mysqli_query($connLocalhost, $queryInsertMascota) or trigger_error("El query de inserción de usuarios falló");

    if ($resQueryMascota) {
      $connLocalhost->close();
      return true;
    } else {
      $connLocalhost->close();
      return false;
    }

    
}

function editarMascota($id, $idRefugio, $nombre, $especie, $edad, $sexo, $observaciones, $estado, $historia)
{
include_once "Entidades/Mascota.php";
include_once("Conexion.php");
$connLocalhost = conexion();

$queryEditMascota = sprintf(
      "UPDATE emp_mascota SET id_refugio ='%d', nombre ='%s', especie='%s', edad='%d', sexo='%s', observaciones='%s', estado='%s', historia= '%s' WHERE id = '%d'",
      mysqli_real_escape_string($connLocalhost, trim($idRefugio)),
      mysqli_real_escape_string($connLocalhost, trim($nombre)),
      mysqli_real_escape_string($connLocalhost, trim($especie)),
      mysqli_real_escape_string($connLocalhost, trim($edad)),
      mysqli_real_escape_string($connLocalhost, trim($sexo)),
      mysqli_real_escape_string($connLocalhost, trim($observaciones)),
      mysqli_real_escape_string($connLocalhost, trim($estado)),
      mysqli_real_escape_string($connLocalhost, trim($historia)),
      mysqli_real_escape_string($connLocalhost, trim($id))

    );

    // Ejecutamos el query en la BD
    $resQueryMascota = mysqli_query($connLocalhost, $queryEditMascota) or trigger_error("El query de inserción de usuarios falló");

    $connLocalhost->close();

}

function eliminarMascota($id){

  include_once("Conexion.php");
	$queryDeleteMascota = sprintf(
    "DELETE from emp_mascota where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryDeleteMascota = mysqli_query($connLocalhost, $queryDeleteMascota) or trigger_error("El query de eliminación de mascotas falló");
}