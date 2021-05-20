<?php 



function obtenerInfoUsuarios(){
include_once "Entidades/UsuarioInfo.php";
include_once("Conexion.php");
$connLocalhost = conexion();

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
$connLocalhost->close();
 return $usuariosInfo;

}

function obtenerInfoUsuariosPorId($idUsuario){
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/UsuarioInfo.php";
  include_once("Conexion.php");
  $connLocalhost = conexion();

   $queryUsuarioInfo = sprintf(
   "SELECT id, edad, direccion, numero_mascotas, telefono, id_usuario, cedula, celular FROM emp_usuario_info WHERE id_usuario = %d",
   mysqli_real_escape_string($connLocalhost, trim($idUsuario))
  );
  
    // Ejecutamos el query
    $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryUsuarioInfo) or trigger_error("El query de login de usuario falló");
  
  $correcto = false;
  
  if (mysqli_num_rows($resQueryUsuarioInfo)) { 
    $infoData = mysqli_fetch_assoc($resQueryUsuarioInfo);

    $info = new UsuarioInfo();
    $info->setId ($infoData['id']);
    $info->setEdad ($infoData['edad']);
    $info->setDireccion ($infoData['direccion']);
    $info->setNumeroMascotas ($infoData['numero_mascotas']);
    $info->setTelefono ( $infoData['telefono']);
    $info->setIdUsuario ($infoData['id_usuario']);
    $info->setCedula ($infoData['cedula']);
    $info->setCelular ($infoData['celular']);
    
    
   
    $connLocalhost->close();
    return $info;
}else{
  $connLocalhost->close();
  return $correcto;
}
  
  
  }


  function obtenerTotalInfo($busqueda){
    include_once "Entidades/UsuarioInfo.php";
    include_once "Entidades/Usuario.php";
    include_once("Conexion.php");
    $connLocalhost = conexion();
    
    $queryTotalUsuarios = sprintf(
     
      "SELECT  DISTINCTROW COUNT(*) as filas
      FROM emp_usuarios as usu left join emp_usuario_info as inf on inf.id_usuario = usu.id
      WHERE  usu.nombre like '%%%s%%' or usu.correo like '%%%s%%' ",
     
     
     
      mysqli_real_escape_string($connLocalhost, $busqueda),
      mysqli_real_escape_string($connLocalhost, $busqueda)
    );
      // Ejecutamos el query
      $resTotalUsuarios = mysqli_query($connLocalhost, $queryTotalUsuarios) or trigger_error("El query de info de usuario falló");
  
      $total = mysqli_fetch_assoc($resTotalUsuarios);
  
      $totalUsuarios = (int)$total['filas'];
  
  
      return $totalUsuarios;
    }
  

  function obtenerInfoCompletaTodosUsuarios($busqueda, $maximo, $mostrar){
    include_once "Entidades/UsuarioInfo.php";
    include_once "Entidades/Usuario.php";
    include_once("Conexion.php");
    $connLocalhost = conexion();
  
     $queryUsuarioInfo = sprintf(
     "SELECT  DISTINCTROW inf.edad as edad_inf, inf.direccion as direccion_inf, inf.numero_mascotas as num_masInf, 
     inf.telefono as telefono_ing, inf.id_usuario as id_user_inf, inf.cedula as cedula_inf, inf.celular as celular_inf, 
     usu.nombre as nombre_us, usu.correo as correo_us, usu.rol as rol_usu, usu.id as id_usu
     FROM emp_usuarios as usu  left join emp_usuario_info as inf on inf.id_usuario = usu.id
     WHERE  usu.nombre like '%%%s%%' or usu.correo like '%%%s%%'  limit %d OFFSET %d",
     mysqli_real_escape_string($connLocalhost, trim($busqueda)),
     mysqli_real_escape_string($connLocalhost, trim($busqueda)),
     mysqli_real_escape_string($connLocalhost, (int)$maximo),
     mysqli_real_escape_string($connLocalhost, (int)$mostrar)
    );
    
      // Ejecutamos el query
      $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryUsuarioInfo) or trigger_error("El query de login de usuario falló");
    
      $usuarios = [];
    
    
    if (mysqli_num_rows($resQueryUsuarioInfo)) { 
      while($infoData = mysqli_fetch_assoc($resQueryUsuarioInfo)){
      $usu = new Usuario();

      $info = new UsuarioInfo();
      $info->setEdad($infoData['edad_inf']);
      $info->setDireccion($infoData['direccion_inf']);
      $info->setNumeroMascotas($infoData['num_masInf']);
      $info->setTelefono($infoData['telefono_ing']);
      $info->setIdUsuario($infoData['id_user_inf']);
      $info->setCedula($infoData['cedula_inf']);
      $info->setCelular($infoData['celular_inf']);

      $usu->setId($infoData['id_usu']);
      $usu->setNombre($infoData['nombre_us']);
      $usu->setCorreo($infoData['correo_us']);
      $usu->setRol($infoData['rol_usu']);
      $usu->setInfo($info);

      array_push($usuarios, $usu);

      }
    }
    $connLocalhost->close();
 return $usuarios;
    
}

  function obtenerInfoCompletaUsuario($idUsuario){
    include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/UsuarioInfo.php";
    include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Usuario.php";
    include_once("Conexion.php");
    $connLocalhost = conexion();
  
     $queryUsuarioInfo = sprintf(
     "SELECT  DISTINCTROW inf.edad as edad_inf, inf.direccion as direccion_inf, inf.numero_mascotas as num_masInf, 
     inf.telefono as telefono_ing, inf.id_usuario as id_user_inf, inf.cedula as cedula_inf, inf.celular as celular_inf, 
     usu.nombre as nombre_us, usu.correo as correo_us, usu.rol as rol_usu
     FROM emp_usuarios as usu  left join emp_usuario_info as inf on inf.id_usuario = usu.id
     WHERE usu.id = %d  ",
     mysqli_real_escape_string($connLocalhost, trim($idUsuario))
    );
    
      // Ejecutamos el query
      $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryUsuarioInfo) or trigger_error("El query de login de usuario falló");
    
    $correcto = false;
    
    $usu = new Usuario();
    if (mysqli_num_rows($resQueryUsuarioInfo)) { 
      $infoData = mysqli_fetch_assoc($resQueryUsuarioInfo);
  

      $info = new UsuarioInfo();
      $info->setEdad($infoData['edad_inf']);
      $info->setDireccion($infoData['direccion_inf']);
      $info->setNumeroMascotas($infoData['num_masInf']);
      $info->setTelefono($infoData['telefono_ing']);
      $info->setIdUsuario($infoData['id_user_inf']);
      $info->setCedula($infoData['cedula_inf']);
      $info->setCelular($infoData['celular_inf']);

     
      $usu->setNombre($infoData['nombre_us']);
      $usu->setCorreo($infoData['correo_us']);
      $usu->setRol($infoData['rol_usu']);
      $usu->setInfo($info);
      $connLocalhost->close();
      return $usu;
 
    }
    return $usu;
    
    
}

function agregarInfoUsuario($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular){

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

function editarUsuarioInfo($edad, $direccion, $numeroMascotas, $telefono, $idUsuario, $cedula, $celular){
include_once("Conexion.php");
$connLocalhost = conexion();


$queryEditUsuarioInfo = sprintf(
      "UPDATE  emp_usuario_info SET  edad ='%d', direccion ='%s', numero_mascotas = '%d', telefono = '%s', id_usuario = '%d', cedula = '%s', celular = '%s'  WHERE id_usuario = '%d' ",
       mysqli_real_escape_string($connLocalhost, trim($edad)),
      mysqli_real_escape_string($connLocalhost, trim($direccion)),
      mysqli_real_escape_string($connLocalhost, trim($numeroMascotas)),
      mysqli_real_escape_string($connLocalhost, trim($telefono)),
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($cedula)),
      mysqli_real_escape_string($connLocalhost, trim($celular)),
      mysqli_real_escape_string($connLocalhost, trim($idUsuario))

     

    );

    // Ejecutamos el query en la BD
    $resQueryEditUsuarioInfo = mysqli_query($connLocalhost, $queryEditUsuarioInfo) or trigger_error("El query de inserción de usuarios falló");

    if ($resQueryEditUsuarioInfo) {
      $connLocalhost->close();
      return true;
    } else {
      $connLocalhost->close();
      return false;
    }
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
