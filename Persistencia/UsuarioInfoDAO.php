<?php 



function obtenerInfoUsuarios()
{
include_once "Entidades/UsuarioInfo.php";
include("Conexion.php");

 $queryUsuarioInfo = "SELECT id, edad, direccion, numero_mascotas, telefono, id_usuario, cedula, celular FROM emp_usuario_info";

  // Ejecutamos el query
  $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryUsuarioInfo) or trigger_error("El query de login de usuario falló");

  $usuariosInfo = [];


if (mysqli_num_rows($resQueryUsuarioInfo)) { 

while ($infoData = mysqli_fetch_assoc($resQueryUsuarioInfo)){
    $info = new UsuarioInfo();
	$info->setId =  $infoData['id'];
	$info->setEdad =  $infoData['edad'];
	$info->setDireccion=  $infoData['direccion'];
	$info->setNumeroMascotas =  $infoData['numero_mascotas'];
	$info->setTelefono =  $infoData['telefono'];
	$info->setIdUsuario =  $infoData['id_usuario'];
	$info->setCedula =  $infoData['cedula'];
	$info->setCelular =  $infoData['celular'];
	
	

	array_push($usuariosInfo, $info);
} 
}

 return $usuariosInfo;

}

function agregarInfoUsuario(  $edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular)
{

include_once("Conexion.php");
  $connLocalhost = conexion();



$queryInsertUsuInfo = sprintf(
      "INSERT INTO emp_usuario_info (edad, direccion, numero_mascotas, telefono, id_usuario, cedula, celular) VALUES ( '%d', '%s', '%d', '%s','%d', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost, trim($edad)),
      mysqli_real_escape_string($connLocalhost, trim($direccion)),
      mysqli_real_escape_string($connLocalhost, trim($numeroMascotas)),
      mysqli_real_escape_string($connLocalhost, trim($telefono)),
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($cedula)),
      mysqli_real_escape_string($connLocalhost, trim($celular))
     

    );

    // Ejecutamos el query en la BD
    $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryInsertUsuInfo) or trigger_error("El query de inserción de usuarios falló");

    if ($resQueryUsuarioInfo) {
      $connLocalhost->close();
      return true;
    } else {
      $connLocalhost->close();
      return false;
    }


    
}

function editarUsuarioInfo($id, $edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular)
{
include_once("Conexion.php");

$queryEditUsuarioInfo = sprintf(
      "UPDATE  emp_usuario_info SET  edad ='%d', direccion ='%s', numero_mascotas = '%d', telefono = '%s', id_usuario = '%d', cedula = '%s', celular = '%s'  WHERE id = '%d' ",
       mysqli_real_escape_string($connLocalhost, trim($edad)),
      mysqli_real_escape_string($connLocalhost, trim($direccion)),
      mysqli_real_escape_string($connLocalhost, trim($numeroMascotas)),
      mysqli_real_escape_string($connLocalhost, trim($telefono)),
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($cedula)),
      mysqli_real_escape_string($connLocalhost, trim($celular)),
      mysqli_real_escape_string($connLocalhost, trim($id))

     

    );

    // Ejecutamos el query en la BD
    $resQueryEditUsuarioInfo = mysqli_query($connLocalhost, $queryEditUsuarioInfo) or trigger_error("El query de inserción de usuarios falló");

    
}

function eliminarUsuarioInfo($id){

	include_once("Conexion.php");
	$queryDeleteUsuarioInfo = sprintf(
    "DELETE from emp_usuario_info where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryDeleteUsuarioInfo = mysqli_query($connLocalhost, $queryDeleteUsuarioInfo) or trigger_error("El query de eliminación de mascotas falló");
}
