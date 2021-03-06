<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "utils.php";

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}
if($_SERVER["REQUEST_METHOD"] != "POST"){
    $returnData = msg(0,404,'Pagina no encontrada');

}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = $_POST;

    if(!isset($data["email"]) 
    || !isset($data["password"])
    || empty(trim($data["email"]))
    || empty(trim($data["password"]))
    ){

    $fields = ['fields' => ['email','password']];
    $returnData = msg(0,422,'Por favor llene todos los recuadros',$fields);
    }else{
        $permitido = false;


    include $_SERVER["DOCUMENT_ROOT"]."/Negocio/UsuarioNegocio.php";

        if (!isset($error)) {
        $permitido = login($_POST['email'],$_POST['password']);
        
    }
    }


    if(isset($permitido) and $permitido)
    {
        if (!isset($_SESSION)) {
            session_start();
          }
          // Definimos variables de sesion en $_SESSION
         
        $returnData = [
            'success' => 1,
            'message' => 'Se ha iniciado sesion',
            'id' =>(int)$_SESSION['userId'],
            'nombre'=> $_SESSION['userNombre'],
            'rol'=> $_SESSION['userRol'],
            'correo'=> $_SESSION['userCorreo'],
            'cuentaActiva'=>(int)$_SESSION['userActiva']

        ];
      header("HTTP/1.1 200 OK");
      echo json_encode($returnData);
      exit();
	 }else{

        $returnData = msg(0,422,'Credenciales invalidas');
     }
      

    }
    echo json_encode($returnData); 
    ?>
