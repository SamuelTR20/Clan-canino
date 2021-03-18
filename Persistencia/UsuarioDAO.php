<?php 



function obtenerUsuarios()
{
include_once "Entidades/Usuario.php";
include("Conexion.php");

 $queryUsuarios = "SELECT id, nombre, correo, contrasenia, rol FROM emp_usuarios";

  // Ejecutamos el query
  $resQueryUsuarios = mysqli_query($connLocalhost, $queryUsuarios) or trigger_error("El query de login de usuario falló");

  $usuarios = [];


if (mysqli_num_rows($resQueryUsuarios)) { 

while ($usersData = mysqli_fetch_assoc($resQueryUsuarios)){
    $usu = new Usuario();
	$usu->id =  $usersData['id'];
	$usu->nombre =  $usersData['nombre'];
	$usu->contrasenia =  $usersData['contrasenia'];
	$usu->correo =  $usersData['correo'];
	$usu->rol =  $usersData['rol'];

	array_push($usuarios, $usu);
} 
}

 return $usuarios;

}

function agregarUsuario( $nombre, $correo, $contrasenia, $rol)
{
include_once "Entidades/Usuario.php";
include_once("Conexion.php");

$queryInsertUsuario = sprintf(
      "INSERT INTO emp_usuarios (nombre, correo, contrasenia, rol) VALUES ( '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost, trim($nombre)),
      mysqli_real_escape_string($connLocalhost, trim($correo)),
      mysqli_real_escape_string($connLocalhost, trim($contrasenia)),
      mysqli_real_escape_string($connLocalhost, trim($rol))
     

    );

    // Ejecutamos el query en la BD
    $resQueryUsuario = mysqli_query($connLocalhost, $queryInsertUsuario) or trigger_error("El query de inserción de usuarios falló");

    
}


function editarUsuario($id, $nombre, $correo, $contrasenia, $rol)
{
include_once "Entidades/Usuario.php";
include_once("Conexion.php");

$queryEditUsuario = sprintf(
      "UPDATE  emp_usuarios SET nombre = '%s', correo = '%s', contrasenia = '%s', rol = '%s'WHERE id = '%d' ",
      mysqli_real_escape_string($connLocalhost, trim($nombre)),
      mysqli_real_escape_string($connLocalhost, trim($correo)),
      mysqli_real_escape_string($connLocalhost, trim($contrasenia)),
      mysqli_real_escape_string($connLocalhost, trim($rol)),
      mysqli_real_escape_string($connLocalhost, trim($id))

     

    );

    // Ejecutamos el query en la BD
    $resQueryUsuario = mysqli_query($connLocalhost, $queryEditUsuario) or trigger_error("El query de inserción de usuarios falló");

    
}
function eliminarUsuario($id){

  include_once("Conexion.php");
  $queryDeleteUsuario = sprintf(
    "DELETE from emp_usuarios where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryUserData = mysqli_query($connLocalhost, $queryDeleteUsuario) or trigger_error("El query de eliminación de mascotas falló");
}