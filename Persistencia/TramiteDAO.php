<?php 


function obtenerTotalTramCliente($busqueda, $id){
  include_once "Entidades/Tramite.php";
  include_once "Entidades/Mascota.php";
  include_once "Entidades/UsuarioInfo.php";
  include_once "Entidades/Usuario.php";
  include_once "Entidades/Refugio.php";
  include_once("Conexion.php");
  $connLocalhost = conexion();
  
  $queryTotalUsuarios = sprintf(
   
    "SELECT  DISTINCTROW COUNT(*) as filas
   from emp_tramite as tra join emp_usuarios as usu on tra.id_usuario = usu.id 
join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id 
join emp_usuario_info as inf on usu.id=inf.id_usuario where usu.id='%s' and (tra.estado like '%%%s%%' or usu.nombre like '%%%s%%' or mas.nombre like '%%%s%%')",
   
   mysqli_real_escape_string($connLocalhost, $id),
   mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda)
  );
    // Ejecutamos el query
    $resTotalUsuarios = mysqli_query($connLocalhost, $queryTotalUsuarios) or trigger_error("El query de info de usuario falló");

    $total = mysqli_fetch_assoc($resTotalUsuarios);

    $totalUsuarios = (int)$total['filas'];


    return $totalUsuarios;
  }


function obtenerTramitesCliente($busqueda, $maximo, $mostrar,$id)
{
include_once "Entidades/Tramite.php";
include_once "Entidades/Mascota.php";
include_once "Entidades/UsuarioInfo.php";
include_once "Entidades/Usuario.php";
include_once "Entidades/Refugio.php";


include_once("Conexion.php");
$connLocalhost = conexion();

$queryGetTram = sprintf("SELECT  DISTINCTROW tra.id as id_tramite, usu.id as id_us, usu.nombre as nombre_us, 
usu.correo as correo_usu, inf.telefono as tel_usu, inf.celular as cel_usu, 
mas.nombre as nombre_mas, mas.especie as especie_mas, mas.sexo as sexo_mas, mas.id as id_mas,
ref.nombre as nombre_ref, ref.ciudad as ciudad_ref, ref.telefono as telefono_ref,
tra.estado as estado_tra, tra.fecha_solicitud as fecha_tra
from emp_tramite as tra join emp_usuarios as usu on tra.id_usuario = usu.id 
join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id 
join emp_usuario_info as inf on usu.id=inf.id_usuario where usu.id = '%s' and (tra.estado like '%%%s%%' or usu.nombre like '%%%s%%' or mas.nombre like '%%%s%%') order by tra.fecha_solicitud desc limit %d OFFSET %d",
mysqli_real_escape_string($connLocalhost, $id),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, (int)$maximo),
mysqli_real_escape_string($connLocalhost, (int)$mostrar));


  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryGetTram) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
  
  $myDateTime = new DateTime($tramData['fecha_tra']);
  $fecha = $myDateTime->format('d-m-y H:i');
      
  $info = new UsuarioInfo();
  $info->setTelefono ( $tramData['tel_usu']);
  $info->setIdUsuario ($tramData['id_us']);
  $info->setCelular ($tramData['cel_usu']);

  $usu = new Usuario();
  $usu->setId ( $tramData['id_us']);
  $usu->setNombre($tramData['nombre_us']);
  $usu->setCorreo($tramData['correo_usu']);
  $usu->setInfo($info);

  $ref = new Refugio();
  $ref->setNombre($tramData['nombre_ref']);
	$ref->setCiudad($tramData['ciudad_ref']);
	$ref->setTelefono($tramData['telefono_ref']);


  $masc = new Mascota();
  $masc->setId($tramData['id_mas']);
	$masc->setNombre($tramData['nombre_mas']);
	$masc->setSexo($tramData['sexo_mas']);
	$masc->setEspecie($tramData['especie_mas']);
  $masc->setIdRefugio($tramData['fecha_tra']);


  
  $tram = new Tramite();
	$tram->setId($tramData['id_tramite']);
	$tram->setIdUsuario($usu);
	$tram->setIdMascota($masc);
	$tram->setEstado($tramData['estado_tra']);
	$tram->setFechaSolicitud ($fecha);
	
	

	array_push($Tramites, $tram);
} 
}
 $connLocalhost->close();
 return $Tramites;

}




function obtenerTotalTram($busqueda){
  include_once "Entidades/Tramite.php";
  include_once "Entidades/Mascota.php";
  include_once "Entidades/UsuarioInfo.php";
  include_once "Entidades/Usuario.php";
  include_once "Entidades/Refugio.php";
  include_once("Conexion.php");
  $connLocalhost = conexion();
  
  $queryTotalUsuarios = sprintf(
   
    "SELECT  DISTINCTROW COUNT(*) as filas
   from emp_tramite as tra join emp_usuarios as usu on tra.id_usuario = usu.id 
join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id 
join emp_usuario_info as inf on usu.id=inf.id_usuario where tra.estado like '%%%s%%' or usu.nombre like '%%%s%%' or mas.nombre like '%%%s%%'",
   
   mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda)
  );
    // Ejecutamos el query
    $resTotalUsuarios = mysqli_query($connLocalhost, $queryTotalUsuarios) or trigger_error("El query de info de usuario falló");

    $total = mysqli_fetch_assoc($resTotalUsuarios);

    $totalUsuarios = (int)$total['filas'];


    return $totalUsuarios;
  }






function obtenerTramites($busqueda, $maximo, $mostrar)
{
include_once "Entidades/Tramite.php";
include_once "Entidades/Mascota.php";
include_once "Entidades/UsuarioInfo.php";
include_once "Entidades/Usuario.php";
include_once "Entidades/Refugio.php";


include_once("Conexion.php");
$connLocalhost = conexion();

$queryGetTram = sprintf("SELECT  DISTINCTROW tra.id as id_tramite, usu.id as id_us, usu.nombre as nombre_us, 
usu.correo as correo_usu, inf.telefono as tel_usu, inf.celular as cel_usu, 
mas.nombre as nombre_mas, mas.especie as especie_mas, mas.sexo as sexo_mas, mas.id as id_mas,
ref.nombre as nombre_ref, ref.ciudad as ciudad_ref, ref.telefono as telefono_ref,
tra.estado as estado_tra, tra.fecha_solicitud as fecha_tra
from emp_tramite as tra join emp_usuarios as usu on tra.id_usuario = usu.id 
join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id 
join emp_usuario_info as inf on usu.id=inf.id_usuario where tra.estado like '%%%s%%' or usu.nombre like '%%%s%%' or mas.nombre like '%%%s%%' order by tra.fecha_solicitud desc  limit %d OFFSET %d",
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, $busqueda),
mysqli_real_escape_string($connLocalhost, (int)$maximo),
mysqli_real_escape_string($connLocalhost, (int)$mostrar));


  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryGetTram) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
  
  $myDateTime = new DateTime($tramData['fecha_tra']);
  $fecha = $myDateTime->format('d-m-y H:i');
      
  $info = new UsuarioInfo();
  $info->setTelefono ( $tramData['tel_usu']);
  $info->setIdUsuario ($tramData['id_us']);
  $info->setCelular ($tramData['cel_usu']);

  $usu = new Usuario();
  $usu->setId ( $tramData['id_us']);
  $usu->setNombre($tramData['nombre_us']);
  $usu->setCorreo($tramData['correo_usu']);
  $usu->setInfo($info);

  $ref = new Refugio();
  $ref->setNombre($tramData['nombre_ref']);
	$ref->setCiudad($tramData['ciudad_ref']);
	$ref->setTelefono($tramData['telefono_ref']);


  $masc = new Mascota();
  $masc->setId($tramData['id_mas']);
	$masc->setNombre($tramData['nombre_mas']);
	$masc->setSexo($tramData['sexo_mas']);
	$masc->setEspecie($tramData['especie_mas']);
  $masc->setIdRefugio($ref);


  
  $tram = new Tramite();
	$tram->setId($tramData['id_tramite']);
	$tram->setIdUsuario($usu);
	$tram->setIdMascota($masc);
	$tram->setEstado($tramData['estado_tra']);
	$tram->setFechaSolicitud ($fecha);
	
	

	array_push($Tramites, $tram);
} 
}
 $connLocalhost->close();
 return $Tramites;

}






function obtenerTramiteId($id){
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Usuario.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Refugio.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Tramite.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Mascota.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/UsuarioInfo.php";


include_once("Conexion.php");
$connLocalhost = conexion();

$queryTramiteData = sprintf(
  "SELECT   tra.id as id_tramite, mas.id as id_mascota, usu.id as id_us, usu.nombre as nombre_us, usu.correo as correo_us,
   inf.edad as edad_us, inf.direccion as direccion_us,  inf.numero_mascotas as num_mas, inf.telefono as tel_usu,
   inf.celular as cel_usu, inf.cedula as cedula_usu,
    mas.nombre as nombre_mas, mas.edad as edad_mas, mas.especie as especie_mas, mas.sexo as sexo_mas, mas.foto as foto, 
    mas.observaciones as observaciones_mas, mas.estado as estado_mas, mas.id as id_mas,
    ref.nombre as nombre_ref, ref.ciudad as ciudad_ref, ref.telefono as telefono_ref, ref.direccion as direccion_ref, 
    tra.estado as estado_tra, tra.fecha_solicitud as fecha_tra 
    from emp_tramite as tra join emp_usuarios as usu 
    on tra.id_usuario = usu.id 
    join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id join emp_usuario_info as inf on usu.id=inf.id_usuario where (tra.id = %d)",
  mysqli_real_escape_string($connLocalhost, trim($id))
);
// Ejecutamos el query
$resQueryGetTram = mysqli_query($connLocalhost, $queryTramiteData) or trigger_error("El query de inserción de usuarios falló");
  


$tram = new Tramite();


if (mysqli_num_rows($resQueryGetTram)) {  
  $tramData = mysqli_fetch_assoc($resQueryGetTram);
  
  $info = new UsuarioInfo();
  $info->setEdad( $tramData['edad_us']);
  $info->setDireccion($tramData['direccion_us']);
  $info->setNumeroMascotas($tramData['num_mas']);
  $info->setCedula($tramData['cedula_usu']);
  $info->setTelefono ( $tramData['tel_usu']);
  $info->setIdUsuario ($tramData['id_us']);
  $info->setCelular ($tramData['cel_usu']);

  $usu = new Usuario();
  $usu->setId ( $tramData['id_us']);
  $usu->setNombre($tramData['nombre_us']);
  $usu->setCorreo($tramData['correo_us']);
  $usu->setInfo($info);

  $ref = new Refugio();
  $ref->setNombre($tramData['nombre_ref']);
	$ref->setCiudad($tramData['ciudad_ref']);
	$ref->setTelefono($tramData['telefono_ref']);
  $ref->setDireccion($tramData['direccion_ref']);


  $masc = new Mascota();
	$masc->setNombre($tramData['nombre_mas']);
	$masc->setId($tramData['id_mas']);
  $masc->setEdad($tramData['edad_mas']);
	$masc->setSexo($tramData['sexo_mas']);
  $masc->setFoto($tramData['foto']);
  $masc->setObservaciones($tramData['observaciones_mas']);
  $masc->setEstado($tramData['estado_mas']);
	$masc->setEspecie($tramData['especie_mas']);
  $masc->setIdRefugio($ref);

	$tram->setId($tramData['id_tramite']);
	$tram->setIdUsuario($usu);
	$tram->setIdMascota($masc);
	$tram->setEstado($tramData['estado_tra']);
	$tram->setFechaSolicitud ($tramData['fecha_tra']);
 
  $connLocalhost->close();
  return $tram;

}else{
 $connLocalhost->close();
 return false;
}

}




function obtenerTramites2()
{
  include_once("Conexion.php");
  $connLocalhost = conexion();

 $queryTramites = sprintf("SELECT id, id_usuario, id_mascota, estado, fecha_solicitud FROM emp_tramite"
);

  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryTramites) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
    $tram = new Tramite();
	$tram->setId =  $tramData['id'];
	$tram->setIdUsuario =  $tramData['id_usuario'];
	$tram->setIdMascota=  $tramData['id_mascota'];
	$tram->setEstado =  $tramData['estado'];
	$tram->setFechaSolicitud =  $tramData['fecha_solicitud'];
	
	

	array_push($Tramites, $tram);
} 
}

 return $Tramites;

}


function obtenerTramitePorMascota($idMascota, $idUsuario)
{
  include_once($_SERVER["DOCUMENT_ROOT"]."/Entidades/Tramite.php");
  include_once("Conexion.php");
  $connLocalhost = conexion();

 $queryTramites = sprintf("SELECT id, id_usuario, id_mascota, estado, fecha_solicitud FROM emp_tramite WHERE id_usuario = '%d' and id_mascota = '%d' ",
 mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
 mysqli_real_escape_string($connLocalhost, trim($idMascota)));

  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryTramites) or trigger_error("El query de login de usuario falló");

  $tram = new Tramite();
$exito = false;

if (mysqli_num_rows($resQueryTramites) == 1) { 
while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
    
	$tram->setId($tramData['id']);
	$tram->setIdUsuario($tramData['id_usuario']);
	$tram->setIdMascota($tramData['id_mascota']);
	$tram->setEstado($tramData['estado']);
	$tram->setFechaSolicitud($tramData['fecha_solicitud']);
	
	


} 
$connLocalhost->close();
$exito = true;
return $tram;
}else{
 return $exito;}
 return $exito;

}

function agregarTramite( $idUsuario, $idMascota, $estado)
{

  include_once("Conexion.php");
  $connLocalhost = conexion();

  date_default_timezone_set('America/Hermosillo');
  $date = date("Y-m-d G:i:s");

$queryInsertTramite = sprintf(
  "INSERT INTO emp_tramite (id_usuario, id_mascota, estado, fecha_solicitud) VALUES ( '%d', '%d', '%s', '$date' )",
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($idMascota)),
      mysqli_real_escape_string($connLocalhost, trim($estado))
     

    );

    // Ejecutamos el query en la BD
    $resQueryTramite = mysqli_query($connLocalhost, $queryInsertTramite) or trigger_error("El query de inserción de usuarios falló");

    if ($resQueryTramite) {
      $connLocalhost->close();
      return true;
    } else {
      $connLocalhost->close();
      return false;
    }


    
}


function editarEstado($id, $estado)
{
  include_once("Conexion.php");
  $connLocalhost = conexion();

  $queryEditTramite = sprintf(
    "UPDATE emp_tramite SET estado = '%s' where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($estado)),
    mysqli_real_escape_string($connLocalhost, trim($id))
  );

    // Ejecutamos el query en la BD
    $resQueryTramite = mysqli_query($connLocalhost, $queryEditTramite) or trigger_error("El query de inserción de usuarios falló");
    

  //Cancelar los otros tramites con la misma mascota
    
    $connLocalhost->close();

    return $resQueryTramite;

}


function cancelarTramites($idMascota){
  include_once("Conexion.php");
  $connLocalhost = conexion();

    $queryCancelarTodos = sprintf(
      "UPDATE emp_tramite SET estado = 'cancelado' where id_mascota = %d and estado != 'aceptado'",
      mysqli_real_escape_string($connLocalhost, trim($idMascota))
    );
    // Ejecutamos el query
    $resQueryGetTram = mysqli_query($connLocalhost, $queryCancelarTodos) or trigger_error("El query de inserción de usuarios falló");


    $queryDisponibilidad = sprintf(
      "UPDATE emp_mascota SET estado = 'adoptado' where id = %d",
      mysqli_real_escape_string($connLocalhost, trim($idMascota))
    );
    // Ejecutamos el query
    $resQueryGetTram = mysqli_query($connLocalhost, $queryDisponibilidad) or trigger_error("El query de inserción de usuarios falló");
  
    $connLocalhost->close();

}






function editarTramite($id, $idUsuario, $idMascota, $estado)
{
include_once("Conexion.php");

$queryEditTramite = sprintf(
      "UPDATE  emp_tramite SET id_usuario = '%d', id_mascota = '%d', estado = '%s' WHERE id = '%d' ",
      mysqli_real_escape_string($connLocalhost, trim($idUsuario)),
      mysqli_real_escape_string($connLocalhost, trim($idMascota)),
      mysqli_real_escape_string($connLocalhost, trim($estado)),
      mysqli_real_escape_string($connLocalhost, trim($id))

     

    );

    // Ejecutamos el query en la BD
    $resQueryTramite = mysqli_query($connLocalhost, $queryEditTramite) or trigger_error("El query de inserción de usuarios falló");

    
}

function eliminarTramite($id){

  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Tramite.php";


include_once("Conexion.php");
$connLocalhost = conexion();

	$queryDeleteTramite = sprintf(
    "DELETE from emp_tramite where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryUsuarioInfo = mysqli_query($connLocalhost, $queryDeleteTramite) or trigger_error("El query de eliminación de mascotas falló");

if($resQueryUsuarioInfo){
  $connLocalhost->close();
return true;
}else{
  $connLocalhost->close();
  return false;}


}


function obtenerTramitesClienteAPI($id)
{

  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Usuario.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Refugio.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Tramite.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/Mascota.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."/Entidades/UsuarioInfo.php";


include_once("Conexion.php");
$connLocalhost = conexion();

$queryGetTram = sprintf("SELECT  DISTINCTROW tra.id as id_tramite, usu.id as id_us, usu.nombre as nombre_us, 
usu.correo as correo_usu, mas.foto as foto_mas, mas.edad as edad_mas, mas.especie as especie_mas, mas.sexo as sexo_mas, mas.id as id_mas, mas.nombre as nombre_mas,
ref.nombre as nombre_ref, ref.ciudad as ciudad_ref, ref.telefono as telefono_ref,
tra.estado as estado_tra, tra.fecha_solicitud as fecha_tra
from emp_tramite as tra join emp_usuarios as usu on tra.id_usuario = usu.id 
join emp_mascota as mas on tra.id_mascota=mas.id join emp_refugio as ref on mas.id_refugio = ref.id 
join emp_usuario_info as inf on usu.id=inf.id_usuario where usu.id = '%d' order by tra.fecha_solicitud desc ",
mysqli_real_escape_string($connLocalhost, $id));


  // Ejecutamos el query
  $resQueryTramites = mysqli_query($connLocalhost, $queryGetTram) or trigger_error("El query de login de usuario falló");

  $Tramites = [];


if (mysqli_num_rows($resQueryTramites)) { 

while ($tramData = mysqli_fetch_assoc($resQueryTramites)){
  
  $myDateTime = new DateTime($tramData['fecha_tra']);
  $fecha = $myDateTime->format('d-m-y H:i');
  
  $usu = new Usuario();
  $usu->setId ( $tramData['id_us']);
  $usu->setNombre($tramData['nombre_us']);
  $usu->setCorreo($tramData['correo_usu']);


  $ref = new Refugio();
  $ref->setNombre($tramData['nombre_ref']);
	$ref->setCiudad($tramData['ciudad_ref']);
	$ref->setTelefono($tramData['telefono_ref']);


  $masc = new Mascota();
  $masc->setId($tramData['id_mas']);
	$masc->setNombre($tramData['nombre_mas']);
	$masc->setSexo($tramData['sexo_mas']);
  $masc->setEdad($tramData['edad_mas']);
	$masc->setEspecie($tramData['especie_mas']);
  $masc->setFoto($tramData['foto_mas']);
  $masc->setIdRefugio($ref);


  
  $tram = new Tramite();
	$tram->setId($tramData['id_tramite']);
	$tram->setIdUsuario($usu);
	$tram->setIdMascota($masc);
	$tram->setEstado($tramData['estado_tra']);
	$tram->setFechaSolicitud ($fecha);
	
	

	array_push($Tramites, $tram);
} 
$connLocalhost->close();
return $Tramites;
}else{
 $connLocalhost->close();
 return false;
}
}