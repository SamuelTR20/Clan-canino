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
    || !isset($data["name"])
    || empty(trim($data["email"]))
    || empty(trim($data["name"]))
    || empty(trim($data["password"]))
    ){

    $fields = ['fields' => ['email','password', 'name']];
    $returnData = msg(0,422,'Por favor llene todos los recuadros',$fields);
    }else{
        $permitido = false;


        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/UsuarioNegocio.php";

        $correcto = addUsuario($_POST['name'],$_POST['email'], $_POST['password'], $_POST['password']);
        
        if ($correcto == 1) {
            $returnData = [
                'success' => 1,
                'message' => 'Se ha registrado con exito'
            ];
          header("HTTP/1.1 200 OK");
          echo json_encode($returnData);
          exit();

            }else{
                $returnData = msg(0,422, $correcto[0]);    
            }
    }
    }
    echo json_encode($returnData); 
    ?>
