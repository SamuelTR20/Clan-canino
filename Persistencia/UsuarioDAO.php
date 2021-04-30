<?php
if (!isset($_SESSION)) {
  session_start();
  // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión

}

function obtenerUsuarios(){
  include_once("Conexion.php");
  $connLocalhost = conexion();

  include_once "Entidades/Usuario.php";

  $queryUsuarios = "SELECT id, nombre, correo, contrasenia, rol FROM emp_usuarios";

  // Ejecutamos el query
  $resQueryUsuarios = mysqli_query($connLocalhost, $queryUsuarios) or trigger_error("El query de login de usuario falló");

  $usuarios = [];


  if (mysqli_num_rows($resQueryUsuarios)) {

    while ($usersData = mysqli_fetch_assoc($resQueryUsuarios)) {
      $usu = new Usuario();
      $usu->setId =  $usersData['id'];
      $usu->setNombre =  $usersData['nombre'];
      $usu->setContrasenia =  $usersData['contrasenia'];
      $usu->setCorreo =  $usersData['correo'];
      $usu->setRol =  $usersData['rol'];

      array_push($usuarios, $usu);
    }
  }
  $connLocalhost->close();
  return $usuarios;
}


function agregarUsuario($nombre, $email, $contrasenia){
  include_once("Conexion.php");
  $connLocalhost = conexion();

  include_once "Entidades/Usuario.php";

  $queryInsertUsuario = sprintf(
    "INSERT INTO emp_usuarios (nombre, correo, contrasenia, rol) VALUES ( '%s', '%s', '%s', '%s')",
    mysqli_real_escape_string($connLocalhost, trim($nombre)),
    mysqli_real_escape_string($connLocalhost, trim($email)),
    mysqli_real_escape_string($connLocalhost, trim($contrasenia)),
    mysqli_real_escape_string($connLocalhost, 'cliente')

  );

  // Ejecutamos el query en la BD
  $resQueryUsuario = mysqli_query($connLocalhost, $queryInsertUsuario) or trigger_error("El query de inserción de usuarios falló");


  if ($resQueryUsuario) {
    $connLocalhost->close();
    return true;
  } else {
    $connLocalhost->close();
    return false;
  }
}


function editarUsuario($id, $nombre, $correo, $contrasenia, $rol){
  include_once("Conexion.php");
  $connLocalhost = conexion();

  include_once "Entidades/Usuario.php";

  $queryEditUsuario = sprintf(
    "UPDATE  emp_usuarios SET nombre = '%s', correo = '%s', contrasenia = '%s', rol = '%s' WHERE id = '%d' ",
    mysqli_real_escape_string($connLocalhost, trim($nombre)),
    mysqli_real_escape_string($connLocalhost, trim($correo)),
    mysqli_real_escape_string($connLocalhost, trim($contrasenia)),
    mysqli_real_escape_string($connLocalhost, trim($rol)),
    mysqli_real_escape_string($connLocalhost, trim($id))



  );


  // Ejecutamos el query en la BD
  $resQueryUsuario = mysqli_query($connLocalhost, $queryEditUsuario) or trigger_error("El query de inserción de usuarios falló");


  if ($resQueryUsuario) {
    $connLocalhost->close();

    if (!isset($_SESSION)) {
      session_start();
    }
    // Definimos variables de sesion en $_SESSION
    $_SESSION['userId'] = $id;
    $_SESSION['userNombre'] = $nombre;
    $_SESSION['userCorreo'] = $correo;
    $_SESSION['userContrasenia'] =$contrasenia;
    $_SESSION['userRol'] = $rol;




    return true;
  } else {
    $connLocalhost->close();
    return false;
  }

}

function iniciarSesion($correo, $contrasenia){
  include_once("Conexion.php");
  $connLocalhost = conexion();
  

  $permitido = false;
  include_once("Entidades/Usuario.php");
  // Armamos el query para verificar el correo y contraseña en la base de datos
  $queryLogin = sprintf(
    "SELECT id, nombre, correo, contrasenia, rol FROM emp_usuarios WHERE correo = '%s' AND contrasenia = '%s'",
    mysqli_real_escape_string($connLocalhost, trim($correo)),
    mysqli_real_escape_string($connLocalhost, trim($contrasenia))
  );

  // Ejecutamos el query
  $resQueryLogin = mysqli_query($connLocalhost, $queryLogin) or trigger_error("El query de login de usuario falló");

  // Determinamos si el login es valido (email y password sean coincidentes)
  // Contamos el recordset (el resultado esperado para un login valido es 1)
  if (mysqli_num_rows($resQueryLogin) == 1) {
    // Hacemos un fetch del recordset
    $userData = mysqli_fetch_assoc($resQueryLogin);
    if (!isset($_SESSION)) {
      session_start();
    }
    // Definimos variables de sesion en $_SESSION
    $_SESSION['userId'] = $userData['id'];
    $_SESSION['userNombre'] = $userData['nombre'];
    $_SESSION['userCorreo'] = $userData['correo'];
    $_SESSION['userContrasenia'] = $userData['contrasenia'];
    $_SESSION['userRol'] = $userData['rol'];

    $permitido = true;

    $connLocalhost->close();
    return $permitido;
    // Redireccionamos al usuario al panel de control

    //nombre de redirección pendiente.

  } else {
    $connLocalhost->close();
    return $permitido;
  }
}

function eliminarUsuario($id){
  include_once("Conexion.php");
  $connLocalhost = conexion();

  $queryDeleteUsuario = sprintf(
    "DELETE from emp_usuarios where id = '%d'",
    mysqli_real_escape_string($connLocalhost, trim($id))

  );

  // Ejecutamos el query en la BD
  $resQueryUserData = mysqli_query($connLocalhost, $queryDeleteUsuario) or trigger_error("El query de eliminación de mascotas falló");
  $connLocalhost->close();
}

function verificarEmail($correo){
  include_once("Conexion.php");
  $connLocalhost = conexion();
 

  $queryCheckEmail = sprintf(
    "SELECT id FROM emp_usuarios WHERE correo = '%s'",
    mysqli_real_escape_string($connLocalhost, trim($correo))
  );

  $resQueryCheckEmail = mysqli_query($connLocalhost, $queryCheckEmail) or trigger_error("El query de validación de email falló");

  if (mysqli_num_rows($resQueryCheckEmail)) {
    $connLocalhost->close();
    return true;
  } else {
    $connLocalhost->close();
    return false;
  }
}


?>