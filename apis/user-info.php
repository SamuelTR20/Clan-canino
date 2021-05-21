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

    if(!isset($data["idUsuario"]) 
    || !isset($data["idMascota"])
    || !isset($data["edad"])
    || !isset($data["direccion"])
    || !isset($data["numeroMascotas"])
    || !isset($data["telefono"])
    || !isset($data["cedula"])
    || !isset($data["celular"])
    || empty(trim($data["idUsuario"]))
    || empty(trim($data["idMascota"]))
    || empty(trim($data["edad"]))
    || empty(trim($data["direccion"]))
    || empty(trim($data["telefono"]))
    || empty(trim($data["cedula"]))
    || empty(trim($data["celular"]))
    ){

    $fields = ['fields' => ['idUsuario','edad', 'direccion', 'numeroMascotas', 'telefono', 'cedula', 'celular', 'idMascota']];
    $returnData = msg(0,422,'Por favor llene todos los recuadros',$fields);
    }else{
        $permitido = false;


        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/UsuarioInfoNegocio.php";
        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/TramiteNegocio.php";


        $existe = infoById($data["idUsuario"]);


        if ($existe){
            $permitido = UpdateInfo((int)$data["edad"],$data["direccion"],(int)$data['numeroMascotas'], $data['telefono'], (int)$data['idUsuario'], $data['cedula'], $data['celular'] );	
            
        }else {
            $permitido = addInfo((int)$data["edad"],$data["direccion"],(int)$data['numeroMascotas'], $data['telefono'], (int)$data['idUsuario'], $data['cedula'], $data['celular'] );
            }
        
        if ($permitido) {

            $tramitePermitido = addTramite((int)$data["idUsuario"], (int)$data["idMascota"], 'procesando');

            if($tramitePermitido){
            $returnData = [
                'success' => 1,
                'message' => 'Se ha registrado el tramite con exito'
            ];
          header("HTTP/1.1 200 OK");
          echo json_encode($returnData);
          exit();
                
           }else{
            $returnData = msg(0,422, 'No se ha podido completar el registro del tramite');  
           } }else{
                $returnData = msg(0,422, 'No se ha podido completar el registro de tu información');    
            }
    }
    }
    echo json_encode($returnData); 
    ?>
