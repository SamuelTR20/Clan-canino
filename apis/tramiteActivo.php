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
    || !isset($data["idMascota"]) 
    || empty(trim($data["idUsuario"]))
    || empty(trim($data["idMascota"]))
    ){

    $returnData = msg(0,422,'No se tienen los datos necesarios');
    }else{


        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/TramiteNegocio.php";

        $existe = getTramiteMasc((int)$data["idMascota"], (int)$data["idUsuario"]);
        
        if ($existe == false) {
            $returnData = msg(0,423,'No se encontro el tramite');  
           

            }else{ 
                $returnData = [
                    'success' => 1,
                    'message' => "Existe un tramite activo"
                    
                   
                ];
              header("HTTP/1.1 200 OK");
              echo json_encode($returnData);
              exit(); 
            }
    }
    }
    echo json_encode($returnData); 
    ?>