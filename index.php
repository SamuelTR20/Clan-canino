<?php 
include "Negocio/MascotaNegocio.php";
if (!isset($_SESSION)) {
  session_start();
}

$busqueda = "";

if (empty($_GET['buscar'])) {
  $busqueda = "";
} else {
  $busqueda = $_GET['buscar'];
}

if (!isset($_GET['numPag'])) {
  $_GET['numPag'] = 1;
}

$totalMascotas = getTotalMascotas($busqueda);
$maximo = 6;
$pagina = (int)$_GET['numPag'];

$mostrar = ceil($totalMascotas / $maximo);
$pags = $mostrar;
$mostrar =  ((int)$_GET['numPag'] - 1) * $maximo;


$mascotas = getMascotas($busqueda, $mostrar , $maximo);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Clan Canino</title>
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

    <!-- <link rel="stylesheet" href="css/search.css"> -->

  </head>
  <body>
  <?php include("includes/header.php"); ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread"><?php if(isset($_SESSION['userNombre'])) echo $_SESSION['userNombre']?></h1>
          </div>
        </div>
      </div>
    </section>


	<div class="s010   bg-light py-4 text-center" id="mascotas_enc ">
		<form action="index.php" method="GET">
			<div class="inner-form  col-md-6 offset-md-3">
				<div class="basic-search ">
					<div class="input-field">
						<input id="search" type="text" placeholder="Buscar" name='buscar'>
						<input type="text" hidden name = "numPag" value="1">

						<div class="icon-wrap">
							<button type="submit" value="numPag"  class="transparency-glass" >
							<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24">
							<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
							</svg>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row d-flex">
        <?php
        
          foreach($mascotas as $mascota ){ ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="<?php echo "pet.php?idMascota=".$mascota->getId(); ?>"><img class="img-fluid "src="<?php echo $mascota->getFoto(); ?>" alt="This is a image from pet <?php echo $mascota->getNombre(); ?>">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#">April 07, 2020</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="<?php echo "pet.php?idMascota=".$mascota->getId(); ?>"><?php echo $mascota->getNombre()." ". $mascota->getHistoria(); ?></a></h3>
                <a href="pet.php?idMascota=<?php echo $mascota->getId() ?>">Ver más</a>
             
              </div>
            </div>
          </div>
          <?php
          } ?>
         
        </div>
                  <?php
                    include_once("includes/common_functions.php");
                    paginacion($pags, $pagina, $busqueda, "index.php?");
                  ?>
      </div>
    </section>

    <?php include("includes/footer.php");
    
    ?>
    
  

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