<?php

  // Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
    session_start();
    
}




if (isset($_POST['refu_sent'])){

    foreach ($_POST as $inputs => $vars) {
	if(!isset($error)){
	if(trim($vars) == "") $error[] = "Debes ingresar todos los campos";
	}
}
if($_SESSION['userRol']!="admin"){
	$error[]= "No tiene autorización para efectuar cambios";
}



if (!isset($error)) {

include "Negocio/RefugioNegocio.php";
	 editRefugio( $_POST['nombre'], $_POST['ciudad'],  $_POST['telefono'],$_POST['direccion'],  $_POST['descripcion'] );

     header('Location:refugio.php?status=saved');
}else{
    
}

} 

 



?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Clan canino</title>
	<link rel="shortcut icon" href="images/icon.png" >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Refugio <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Refugio </h1>
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
							
							<?php	
	 								if(isset($_SESSION['userRol']) and $_SESSION['userRol'] == 'admin'){
									?>
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Editar Refugio</h3>
										<?php if(isset($_GET['status']) && $_GET['status'] == 'saved' ){	?>
										
										<div class=" alert alert-success" role="alert"><?php echo 'La información se ha guardado exitosamente';?></div>
										<?php }
										 if(isset($error)){
										foreach($error as $err){ ?>
									<div class="alert alert-danger" role="alert"><?php echo $err?></div>
									<?php } } ?>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm" action="refugio.php" enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="nombre">Nombre</label>
														<input type="text" class="form-control" name="nombre" id="name" maxlength="30" value=" <?php echo $_SESSION['refugioNombre']?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="edad">Ciudad</label>
														<input type="text" class="form-control" name="ciudad" id="edad" maxlength="30" value=" <?php echo $_SESSION['refugioCiudad']?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Teléfono </label>
														<input type="number" class="form-control" name="telefono" id="email"  maxlength="16" value=" <?php echo $_SESSION['refugioTelefono']?>" >
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Dirección</label>
														<input type="text" class="form-control" name="direccion" id="email" maxlength="100" value=" <?php echo $_SESSION['refugioDireccion']?>" >
													</div>
												</div>
												<div class="col-md-12"> 
													<div class="form-group">
														<label class="label" for="especie">Descripción </label>
														<textarea type="text" class="form-control" name="descripcion" maxlength="100" id="email"  ><?php echo $_SESSION['refugioDescripcion']?></textarea>
													</div>
												</div>
												
												
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Guardar información" class="btn btn-primary" name="refu_sent">
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
						  <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	


	<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row d-flex no-gutters">
					<div class="col-md-5 d-flex">
						<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/about-1.jpg);">
						</div>
					</div>
					<div class="col-md-7 pl-md-5 py-md-5">
						<div class="heading-section pt-md-5">
					<h2 class="mb-4">Acerca de nosotros</h2>
						</div>
						<div class="row">
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-users icon-pets"></i></div>
								<div class="text pl-3">
									<h4>Clan Canino</h4>
									<p> <?php echo $_SESSION['refugioDescripcion']?></p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
								<div class="text pl-3">
									<h4>¿Qué hacemos?</h4>
									<p>Rescate y reubicación de mascotas de la calle ademas de la elaboración de dispensadores de croquetas y agua.</p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><i class="far fa-heart icon-pets"></i></div>
								<div class="text pl-3">
									<h4>¿Qué somos?</h4>
									<p>Somos un grupo de jóvenes que busca ayudar a los animales sin hogar que se encuentran en las calles.</p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><i class="fas fa-paw icon-pets"></i></span></div>
								<div class="text pl-3">
									<h4>¿Qué esperamos?</h4>
									<p>Concientizar a la sociedad aportando nuestro granito de arena y haciendo eco a futuras generaciones.</p>
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