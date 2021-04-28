<?php

use BenMajor\ImageResize\Image;
include 'benmajor/PHP-Image-Resize-master/src/BenMajor/Image.php';


  // Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
    header('Cache-Control: no cache'); //no cache
    session_cache_limiter('private_no_expire');
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');
}



if (isset($_POST['masc_sent'])){
    foreach ($_POST as $inputs => $vars) {
if(trim($vars) == "") $error[] = "La caja $inputs es obligatoria";
	




}
include 'Negocio/MascotaNegocio.php';
$permitido = false;
if (!isset($error)) {
	
	$mimeType = $_FILES['file']['type'];

    # Generate a new image resize object using a upload image:
    $image = new Image($_FILES['file']['tmp_name']);

    if ($mimeType == "image/png" || $mimeType == "image/gif" || $mimeType == "image/svg+xml" || $mimeType == "image/svg") {
        $image->setTransparency(true); // agregar transparencia si el formato de imagen acepta transparencia
    } else {
        $image->setTransparency(false); // no agregar transparencia si el formato de la imagen no acepta transparencia
    }

	# Set the background to white:
    $image->setBackgroundColor('#ffffff');

    # Contain the image:
    $image->contain(1136, 640);

	$nom = str_replace(' ', '',$_POST['nombre']);
	$nom2 = $nom.rand ( 1 , 10000000 ).".jpg"; 
    $ruta = "images/".$nom2;
    
	$image->output("images");

    echo rename($image->getOutputFilename(), $ruta);

	$permitido = addMascota( 16, $_POST['nombre'], $_POST['especie'], $_POST['edad'], $_POST['sexo'], $_POST['observaciones'],'disponible', $_POST['historia'],$ruta );
	
    }

    if(!$permitido){
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
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Agregar Mascota <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Agregar Mascota</h1>
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
					            <p><span>Ubicación:</span> dirección aqui próximamente</p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Teléfono:</span> <a href="tel://1234567920">622 123 1111</a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Email:</span> <a href="mailto:info@yoursite.com">perla.duran12@gmail.com</a></p>
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
										<h3 class="mb-4">Registrar Mascota</h3>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm" action="agregarMascota.php" enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="nombre">Nombre</label>
														<input type="text" class="form-control" name="nombre" id="name" placeholder="Nombre">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="edad">Edad </label>
														<input type="number" class="form-control" name="edad" id="edad" placeholder="Edad">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Especie </label>
														<input type="text" class="form-control" name="especie" id="email" placeholder="Especie">
													</div>
												</div>
												
												<div class="col-md-6"> 
														<label class="label" for="sexo">Sexo </label>

														<select name="sexo" id="sexo" class="form-control">
                 											<option value="hembra" >Hembra</option>
                  											<option value="macho" >Macho</option>
                										</select>
												</div> 	


												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="observaciones">Observaciones </label>
														<input type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="historia">Historia </label>
														<input type="text" class="form-control" name="historia" id="historia" placeholder="Historia">
													</div>
												</div>
												
                                                <div class="col-md-12">
													<div class="form-group">
														<label class="label" for="file">Foto</label>
														<input type="file" class="form-control" name="file" id="file" placeholder="Agregar">
													</div>
												</div>

												
												
												<div class="col-md-12 pt-2">
													<div class="form-group">
														<input type="submit" value="Guardar información" class="btn btn-primary" name="masc_sent">
														<div class="submitting"></div>
													</div>
												</div>
												
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 d-flex align-items-stretch">
									<div class="info-wrap w-100 p-5 img" style="background-image: url(images/adopt.jpg);">
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