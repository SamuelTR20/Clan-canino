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

    if(!isset($data["id"]) 
    || empty(trim($data["id"]))
    ){

    $returnData = msg(0, 422, 'ID no encontrado');
    }else{
        $permitido = false;


        include $_SERVER["DOCUMENT_ROOT"]."/Negocio/MascotaNegocio.php";

        $mascota = getMascota($data["id"]);
        
        if ($mascota != false) {
            $returnData = [
                'id' => (int)$mascota->getId(),
                'nombre' => $mascota->getNombre(),
	            'idRefugio' => (int)$mascota->getIdRefugio(),
	            'edad' => (int)$mascota->getEdad(),
	            'sexo' => $mascota->getSexo(),
	            'historia' => $mascota->getHistoria(),
	            'foto' => $mascota ->getFoto(),
	            'estado' => $mascota ->getEstado(),
	            'observaciones' => $mascota ->getObservaciones(),
	            'especie' => $mascota -> getEspecie()
            ];
          header("HTTP/1.1 200 OK");
          echo json_encode($returnData);
          exit();

            }else{
                $returnData = msg(0,422, $mascota);    
            }
    }
    }
    echo json_encode($returnData); 
    ?>