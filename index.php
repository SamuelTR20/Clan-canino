<?php 

  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(!isset($_SESSION['userId'])) header('Location: login.php');
}

echo "Hola ". $_SESSION['userNombre'];

?>