<?php



  // Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
    session_start();
    // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
   // if(isset($_SESSION['userId'])) header('Location: index.php');
   // if(!isset($_SESSION['userId'])) header('Location: formulario.php');
}


if (isset($_SESSION['userId'])) {

	
   if (isset($_POST['usu_sent'])){
    foreach ($_POST as $inputs => $vars) {

		if($inputs != "contrasenia1" and $inputs != "contrasenia2" ){
	if(trim($vars) == "") $error[] = "La caja $inputs es obligatoria";
		}
}


$contra = $_POST["contra"];


if($_POST['contra'] == ""){
	$error[] = "Debes ingresar tu contraseña para poder realizar los cambios";

}

if (isset($_POST['contrasenia1']) and $_POST['contrasenia1'] != "" ){

if($_POST['contrasenia1'] != $_POST['contrasenia2']){
	$error[] = "La contraseña nueva y su confirmación no coinciden";
}else{
	$contra = $_POST['contrasenia1'];
}

}

if($_POST["contra"] != $_SESSION['userContrasenia']){
	$error[] = "Debes ingresar correctamente tu contraseña para efectuar los cambios";
}



if (!isset($error)) {

	include 'Negocio/UsuarioNegocio.php';
	$permitido = editUsuario($_SESSION['userId'], $_POST['nombre'], $_POST['correo'],  $contra, $_SESSION['userRol']);




}
}


  } else {
	  
	header('Location: login.php');
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
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Editar Perfil <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Editar Perfil </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							
							
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Editar información</h3>
										<?php if(isset($error)){
		                             	foreach($error as $err){ ?>
	                        		<div class="alert alert-danger" role="alert"><?php echo $err?></div>
		                         	<?php } } ?>
										<form method="POST" id="contactForm" name="contactForm" class="contactForm" action="editarPerfil.php" enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="nombre">Nombre</label>
														<input type="text" class="form-control" name="nombre" id="name" placeholder="Nombre" value=" <?php echo $_SESSION['userNombre']?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="edad">Correo electronico</label>
														<input type="email" class="form-control" name="correo" id="edad" placeholder="Correo" value=" <?php echo $_SESSION['userCorreo']?>">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Contraseña </label>
														<input type="password" class="form-control" name="contra" id="email" placeholder="Contraseña">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Contraseña nueva</label>
														<input type="password" class="form-control" name="contrasenia1" id="email" placeholder="Contraseña">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="especie">Confirma contraseña nueva </label>
														<input type="password" class="form-control" name="contrasenia2" id="email" placeholder="Contraseña">
													</div>
												</div>
												
												
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Guardar información" class="btn btn-primary" name="usu_sent">
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