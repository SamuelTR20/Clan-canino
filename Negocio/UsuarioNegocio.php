<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ($_SERVER["DOCUMENT_ROOT"].'/PHPMailer/Exception.php');
require ($_SERVER["DOCUMENT_ROOT"].'/PHPMailer/PHPMailer.php');
require ($_SERVER["DOCUMENT_ROOT"].'/PHPMailer/SMTP.php');

function addUsuario($nombre, $email, $contrasenia, $contrasenia2){
	$correcto = false;
	//Se manda a llamar el metodo de la persistencia para agregar al usuario a la BD
	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php";

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		
		$error[]="No se ha introducido un email valido";
		}
	if ($contrasenia != $contrasenia2) {
		
		$error[] = "Los contraseñas no son coincidentes";
		}
	if(verificarEmail($email)){
		
		$error[] = "El email ya esta siendo utilizado";
		
	}
	if (!isset($error)) {
	$token = "us".rand(0,100000);
	$correcto = agregarUsuario($nombre, $email, $contrasenia, $token);
	confirmarEmail($email, $token, $nombre);
	return $correcto;
		
	}else {
		$error[] = "Ocurrio un error al registrarse";
		return $error;
	}

}

function confirmarEmail($email, $token, $nombre){




$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'clancanino.gym@gmail.com';                     //SMTP username
    $mail->Password   = 'clancanino';                               //SMTP password
    $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('clancanino.gym@gmail.com', 'Clan Canino');
    $mail->addAddress($email);     //Add a recipient
                 
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->CharSet = 'UTF-8';
	$mail->Subject = 'Clan canino | Activación de cuenta';
    $mail->Body    = "<h2 style='color:black' >¡Bienvenido(a) a Clan Canino!</h2>
	<p style='color:black'> ¡Gracias por registrarte! Al unirte a nosotros aportarás tu granito de arena en apoyo a la comunidad de perros sin hogar, ojalá aquí encuentres al próximo integrante de tu familia y puedas brindarle un hogar.<br>
	Para poder realizar trámites en la plataforma es necesario activar su cuenta, en caso de no ser usted, haga caso omiso a este correo, ¡Gracias!</p> <br>
	
	<a href='localhost/Clan-canino/verificacion.php?token=$token&e=$email'><button  style ='color: #fff; background-color: #28a745; border-color: #28a745; line-height: 2;  border-radius: 1.5rem; display: inline-block; text-align: center; padding: 0.375rem 0.75rem; margin: 0 auto;'>Activar Cuenta</button></a>";

    $mail->send();
} catch (Exception $e) {
    header('Location: login.php');
}




}

function activarCuentaUsuario($correo,$token){
	include_once "Persistencia/UsuarioDAO.php";
	return activarCuenta($correo, $token);

}


function editarUsuarioRol($id, $rol){
	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php";
	return editarRolUsuario($id, $rol);

}




function editUsuario ($id, $nombre, $correo, $contrasenia, $rol){
	//Validamos si las variables  vienen vacias
	if($id=="" || $nombre =="" || $correo=="" || $contrasenia=="" || $rol=="" ){
		echo 'Falta(n) completar campo(s) fdssdf'. $id.$nombre.$correo.$contrasenia.$rol;

	}else{
			//Se manda a llamar el metodo de la persistencia para editar la info del usuario en la BD
			include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php";
		 return	editarUsuario($id, $nombre, $correo, $contrasenia, $rol);
	}
}


function deleteUsuario ($id){


			//Se manda a llamar el metodo de la Persistencia para eliminar al usuario a la BD
			include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php";
			return eliminarUsuario($id);
	
}


function getUsuarios(){

	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php";
	$usuarios = obtenerUsuarios();

	return $usuarios;
	}


function login($correo, $contrasenia){
		//Validamos si las variables  vienen vacias
	if( trim($correo)=="" || trim($contrasenia)=="" ){

	}else{
		include_once($_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php");
		
		$permitido = iniciarSesion($correo, $contrasenia);

return $permitido;
}
}

function obtenerActivacion($id){

	include_once($_SERVER["DOCUMENT_ROOT"]."/Persistencia/UsuarioDAO.php");
	
	$permitido = obtenerUsuarioActivacion($id);

return $permitido;

}






?>
