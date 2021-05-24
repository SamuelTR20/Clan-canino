<?php



function pdf($idTramite){

	if(!empty($idTramite)){
		$tramite =  getTramitePorId($_GET['idTramite']);
	
		if($tramite != false){

	require_once 'librerias/fpdf/fpdf.php';

	$pdf = new FPDF();
	$pdf->AddPage();
	
	//Fecha
	$pdf->SetFont('Arial', '', 12);


// Logo
    $pdf->Image('images/clanc.png',12,8,33);
	
//	$pdf->Cell(10, 10, utf8_decode('Clan canino'), 0,0,'R');
	
	$pdf->setTitle('Clan canino');
	$pdf->cell(120);
	$pdf->Cell(30, 10, utf8_decode("Guaymas, Son. ".$tramite->getFechaSolicitud()), 0,0,'L');
	$pdf->Ln(20);
	//titulo
	$pdf->SetFont('Arial', 'B', 15);

	$pdf->cell(80);
	$pdf->Cell(30, 10, utf8_decode('Reporte adopción'), 0,0,'C');
	$pdf->Ln(20);
	//Info
	$pdf->SetFont('Arial', '', 12);
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('adoptante: '. $tramite->getIdUsuario()->getNombre()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('cedula: '.$tramite->getIdUsuario()->getInfo()->getCedula()));

	$pdf->Ln(20);
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Edad: '.$tramite->getIdUsuario()->getInfo()->getEdad()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Dirección: '.$tramite->getIdUsuario()->getInfo()->getDireccion()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Email: '.$tramite->getIdUsuario()->getCorreo()) );
	$pdf-> Ln(20);

	$pdf->cell(20);
	$pdf->write(5,utf8_decode('celular: '.$tramite->getIdUsuario()->getInfo()->getCelular()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('telefono: '.$tramite->getIdUsuario()->getInfo()->getTelefono()));

	$pdf-> Ln(20);

	$pdf->cell(80);
	$pdf->Cell(30, 10, utf8_decode('Mascota'), 0,0,'C');
	$pdf->Ln(20);
	
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Nombre: '.$tramite->getIdMascota()->getNombre()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Edad: '.$tramite->getIdMascota()->getEdad()));
	$pdf->cell(20);
	$pdf->write(5,utf8_decode('Tipo: '.$tramite->getIdMascota()->getEspecie()));
	$pdf-> Ln(20);

	
	$pdf->write(5,utf8_decode('El adooptante se compromete a las siguientes clausulas: 
	- En caso de que la solicitud sea aceptada se agendará una cita en la vivienda del solicitante para determinar el resultado del proceso de adopción.
	- El hecho de agendar una cita en la vivienda no asegura que la adopción de la mascota se concretará, la cita es para determinar ciertos aspectos antes de la decisión final.
	- Se debe de contar con un espacio apropiado destinado para la mascota.
	- Es importante que haya disponibilidad de las personas para cuidar a la mascota (que no quede solx la mayor parte del tiempo).
	- En caso de que el solicitante sea menor de edad, contar con la autorización y apoyo de sus padres o tutores.'));
	
	
	$pdf-> Ln(20);
	$pdf->cell(80);
	$pdf->Cell(30, 10, utf8_decode('Firma'), 0,0,'C');

	$pdf-> Ln(20);
	$pdf->cell(80);
	$pdf->Cell(30, 10, utf8_decode('_______________________________'), 0,0,'C');




	
	

	$pdf->Output();

}
		else{
			return false;}

}}





function getTramitesCliente($busqueda, $maximo, $mostrar, $id){

	include_once "Persistencia/TramiteDAO.php";
	$tramites = obtenerTramitesCliente($busqueda, $maximo, $mostrar, $id);

	return $tramites;
	}



function getTramites($busqueda, $maximo, $mostrar){

	include_once "Persistencia/TramiteDAO.php";
	$tramites = obtenerTramites($busqueda, $maximo, $mostrar);

	return $tramites;
	}

function getTramitePorId($id){

	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/TramiteDAO.php";
		
		$tramite = obtenerTramiteId($id);
		
		return $tramite;
		}

function getTramitePorIdAPI($id){

		include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/TramiteDAO.php";
				
		$tramite = obtenerTramitesClienteAPI($id);
				
		return $tramite;
			}

function addTramite($idUsuario, $idMascota, $estado){

	if ($idUsuario=="" || $idMascota=="" || $estado==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/TramiteDAO.php";
	
	return	agregarTramite($idUsuario, $idMascota, $estado);
	}
}
function getTramiteMasc($idMascota, $idUsuario){
	include_once($_SERVER["DOCUMENT_ROOT"]."/Persistencia/TramiteDAO.php");
	
	return obtenerTramitePorMascota($idMascota, $idUsuario);

  
}


function editTramite($id, $idUsuario, $idMascota, $estado){

	if ($idUsuario=="" || $idMascota=="" || $estado=="" || $id==""){
				echo 'Falta(n) completar campo(s)';
	}else{

		//Se manda a llamar el metodo de la persistencia para agregar la mascota a la BD
	include_once "Persistencia/TramiteDAO.php";
			editarTramite($id, $idUsuario, $idMascota, $estado );
	}
}


function cambiarEstado($id, $idMascota, $estado){

	include_once "Persistencia/TramiteDAO.php";
	 
	$correcto = editarEstado($id, $estado);
	if($correcto == 1 and $estado == 'aceptado'){
		cancelarTramites($idMascota);
	}

}



function deleteTramite ($id){

	//Validamos si las variables  vienen vacias
	if($id=="" ){
		echo 'Falta seleccionar id';


	}else{
			//Se manda a llamar el metodo de la persistencia para eliminar al usuario a la BD
			
			include_once $_SERVER["DOCUMENT_ROOT"]."/Persistencia/TramiteDAO.php";
			return eliminarTramite($id);
	}
}


function obtenerTotalTramite($busqueda){

	include_once "Persistencia/TramiteDAO.php";
	
	$totalTramites = obtenerTotalTram($busqueda);
	
	return $totalTramites;
	}

	function obtenerTotalTramiteCliente($busqueda, $id){

		include_once "Persistencia/TramiteDAO.php";
		
		$totalTramites = obtenerTotalTramCliente($busqueda, $id);
		
		return $totalTramites;
		}
	


?>
