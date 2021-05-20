<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
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
if($_SERVER["REQUEST_METHOD"] != "GET"){
    $returnData = msg(0,404,'Pagina no encontrada');

}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $data = $_GET;

    if(!isset($data["idUsuario"]) 
    || empty(trim($data["idUsuario"]))
    ){

    $returnData = msg(0,422,'No se tienen los datos necesarios');
    }else{
        $permitido = false;


        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/UsuarioInfoNegocio.php";

        $usu = obtenerInfoCompleta($data["idUsuario"]);
        
        if ($usu != false) {
            $returnData = [
                'success' => 1,
                'nombre' => $usu->getNombre(),
                'correo' => $usu->getCorreo(),
                'edad'=>(int) $usu->getInfo()->getEdad(),
                'direccion'=>  $usu->getInfo()->getDireccion(),
                'numMascotas'=> (int) $usu->getInfo()->getNumeroMascotas(),
                'telefono'=>  $usu->getInfo()->getTelefono(),
                'cedula'=>  $usu->getInfo()->getCedula(),
                'celula'=>  $usu->getInfo()->getCelular()
               
            ];
          header("HTTP/1.1 200 OK");
          echo json_encode($returnData);
          exit();

            }else{
                $returnData = msg(0,423,'No se encontro el usuario');    
            }
    }
    }
    echo json_encode($returnData); 
    ?>