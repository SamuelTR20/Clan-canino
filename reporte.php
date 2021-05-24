<?php 
include "Negocio/TramiteNegocio.php";

if(isset($_GET['idTramite'])){

pdf($_GET['idTramite']);
}else{
    echo "error al abrir pdf";
}









?>