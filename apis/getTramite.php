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

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $data = $_GET;

    if(!isset($data["idUsuario"]) 
    || empty(trim($data["idUsuario"]))
    ){

    $returnData = msg(0,422,'No se tienen los datos necesarios');
    } else{
        

        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/TramiteNegocio.php";
        $tramites = getTramitePorIdAPI((int)$data["idUsuario"]);
        
        $list=array();
        if($tramites != false){
        foreach($tramites as $tram){

          $mascota = [
            'id'=> (int)$tram->getId(),
            'nombreMascota'=> $tram->getIdMascota()->getNombre(),
            'idMascota'=>(int)$tram->getIdMascota()->getId(),
            'foto'=> $tram->getIdMascota()->getFoto(),
            'especie'=>$tram->getIdMascota()->getEspecie(),
            'fecha'=> $tram->getFechaSolicitud(),
            'edad' => (int)$tram->getIdMascota()->getEdad(),
            'idUsuario' => (int)$tram->getIdUsuario()->getId(),
            'estado' => $tram->getEstado()


          ];
          
          $list[]= $mascota;
        }

        //$listMasc = ['mascota' => $list ];
           
          header("HTTP/1.1 200 OK");
          echo json_encode($list);
          exit();

    }
    else{
        $returnData = msg(0,422,'No se tiene ningun registro de tramites con este usuario');
    }
}
}
    
    echo json_encode($returnData); 
    ?>
