<?php
  // Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');
}

if( !isset($_SESSION['userNombre']) ){
	header('Location: login.php');
  
  }
include 'Negocio/TramiteNegocio.php';
include 'Negocio/UsuarioInfoNegocio.php';
$usuario = infoById($_SESSION['userId']);


if(isset($_GET['idMascota'])){
	$idMascota = $_GET['idMascota'];
	
}else if(isset($_POST['idMascota'])){
	$idMascota = $_POST['idMascota'];
	
}
//echo $idMascota;


if (isset($_POST['info_sent'])){

		echo "ENTRA AQUI";
    foreach ($_POST as $inputs => $vars) {
if(trim($vars) == "") {$error[0] = "No se llenaron todos los datos";
	
}
	
}
$permitido = false;
if (!isset($error)) {
	$celular = str_replace(array(':', '\\', '/', '*', ' ', '-', '(', ')'), '', $_POST['celular']);
	$telefono = str_replace(array(':', '\\', '/', '*', ' ', '-', '(', ')'), '', $_POST['telefono']);
	echo "entra a lo anterior";
	
	if ($usuario){
		echo "si entra";
	$permitido = UpdateInfo($_POST['edad'], $_POST['direccion'], $_POST['numeroMascotas'], $telefono, $_SESSION['userId'], $_POST['cedula'], $celular );	
	
}else {
	echo "si entra al segundo";
    $permitido = addInfo( $_POST['edad'], $_POST['direccion'], $_POST['numeroMascotas'], $telefono, $_SESSION['userId'], $_POST['cedula'], $celular );
	}

	
	if($permitido == true and isset($idMascota)){
		$agregado = addTramite($_SESSION['userId'], $idMascota, 'procesando');
		
	}else{
		if(isset($idMascota)){
		$error[] ="Error al ingresar información";
		}
	}



    }

    if(!$permitido and !isset($error)){
        $error[] = "Ha ocurrido un error al registrarse";            
    }

    
    if (!isset($error)) {
        header('Location:index.php');
        }else{

        }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Clan canino</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <?php include("includes/header.php"); ?>


  

    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Adopción <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Formulario de adopción</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 text-center mb-5">
						<h2 class="heading-section">Contáctanos</h2>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row mb-5">
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text">
								<p><span>Ubicación:</span><?php echo $_SESSION['refugioDireccion']?></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Teléfono:</span> <a href="tel://1234567920"> <?php echo $_SESSION['refugioTelefono']?></a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Email:</span> <a href="mailto:info@yoursite.com">clancanino.gym@gmail.com</a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Website</span> <a href="#">Clan-canino.com</a></p>
					          </div>
				          </div>
								</div>
							</div>
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Registrar para adopción</h3>
										<?php if(isset($error)){
	                               		foreach($error as $err){ ?>
	                             		<div class="alert alert-danger" role="alert"><?php echo $err?></div>
	                             		<?php } } ?>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm" action="formulario.php">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="name">Nombre completo</label>
														<input type="text" class="form-control" name="name" id="name" value= <?php echo $_SESSION['userNombre'] ?> disabled>
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="edad">Edad </label>
														<input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" value="<?php if (($usuario)) echo $usuario->getEdad();?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email">Email </label>
														<input type="email" class="form-control" name="email" id="email" value=<?php echo $_SESSION['userCorreo'] ?> disabled>
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="telefono">telefono </label>
														<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?php if($usuario) echo $usuario->getTelefono();?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="numeroMascotas">Número de mascotas </label>
														<input type="number" class="form-control" name="numeroMascotas" id="mascotas" placeholder="Número de mascotas" value="<?php if($usuario) echo $usuario->getNumeroMascotas();?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="celular">Celular </label>
														<input type="text" class="form-control" name="celular" id="celular" placeholder="celular" value="<?php if($usuario) echo $usuario->getCelular();?>">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="cedula">Cedula</label>
														<input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" value="<?php if($usuario) echo $usuario->getCedula();?>">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="#">Dirección</label>
														<textarea name="direccion" class="form-control" id="message" cols="30" rows="4" placeholder="Ingresa tu dirección"><?php if($usuario) echo $usuario->getDireccion();?></textarea>
													</div>
												</div>
												
												<div class="col-md-12">
													<div class="form-group">
													<button <?php if(isset($idMascota)){ ?> type="button"  <?php } else {?> type="submit" name="info_sent"   value="entra" <?php } ?>class="btn btn-primary" <?php if(isset($idMascota)){ ?> data-toggle="modal" data-target="#myModal" <?php } ?>>Guardar Información</button>

														<div class="submitting"></div>
													</div>
												</div>
												<?php if(isset($idMascota)){ ?>
													<div class="modal fade" id="myModal" role="dialog">
														<div class="modal-dialog">
														
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Términos y condiciones</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														
															</div>
															<div class="modal-body">
															<p>Para poder solicitar la adopción de una mascota es importante leer y aceptar los siguientes términos y condiciones:</p>
															<br>
															<p>- En caso de que la solicitud sea aceptada se agendará una cita en la vivienda del solicitante para determinar el resultado del proceso de adopción.</p>
															<p>- El hecho de agendar una cita en la vivienda no asegura que la adopción de la mascota se concretará, la cita es para determinar ciertos aspectos antes de la decisión final.</p>
															<p>- Se debe de contar con un espacio apropiado destinado para la mascota.</p>
															<p>- Es importante que haya disponibilidad de las personas para cuidar a la mascota (que no quede solx la mayor parte del tiempo).</p>
															<p>- En caso de que el solicitante sea menor de edad, contar con la autorización y apoyo de sus padres o tutores.</p>
															</div>
															<div class="modal-footer">
															<?php if(isset($idMascota)){ ?>
															<input type="hidden" name="idMascota" value="<?php echo $idMascota; ?>">
															<?php } ?>
															<input type="submit" value="Aceptar" class="btn btn-primary" name="info_sent">
																<div class="submitting"></div>
															<button type="button" class="btn btn-default" <?php if(isset($idMascota)){ ?> data-dismiss="modal"<?php } ?>>Cancelar</button>
															</div>
														</div>
														
														</div>
													</div>
													<?php } ?>
												
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 d-flex align-items-stretch">
									<div class="info-wrap w-100 p-5 img" style="background-image: url(images/img.jpg);">
				          </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	

		<?php include("includes/footer.php"); ?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>


    
  </body>
</html>