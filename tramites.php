<?php 
include "Negocio/TramiteNegocio.php";
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_POST['Eliminar'])){

  $tram = getTramitePorId($_POST['idTramite']);
  if($tram != false and $tram->getIdUsuario()->getId() == $_SESSION['userId']){

  $eliminado = deleteTramite($_POST['idTramite']);
  if($eliminado == false){
    $error[]="ocurrió un error al eliminar el tramite";

  }

  }

}

if (empty($_GET['buscar'])) {
  $busqueda = "";
} else {
  $busqueda = $_GET['buscar'];
}
if (!isset($_GET['numPag'])) {
  $_GET['numPag'] = 1;
}

$totalTramites = 0;
if( isset($_SESSION['userNombre']) and $_SESSION['userRol'] == "admin"){
$totalTramites = obtenerTotalTramite($busqueda);
}else if( isset($_SESSION['userNombre']) and $_SESSION['userRol'] == "cliente"){
  $totalTramites = obtenerTotalTramiteCliente($busqueda,$_SESSION['userId']);
 
}else{
  header('Location: index.php');

}
$maximo = 10;
$pagina = (int)$_GET['numPag'];

$mostrar = ceil($totalTramites / $maximo);
$pags = $mostrar;
$mostrar =  ((int)$_GET['numPag'] - 1) * $maximo;



if( isset($_SESSION['userNombre']) and $_SESSION['userRol'] == "admin"){
$tramites = getTramites($busqueda, $maximo, $mostrar);
}else if( isset($_SESSION['userNombre']) and $_SESSION['userRol'] == "cliente"){
  $tramites = getTramitesCliente($busqueda, $maximo, $mostrar, $_SESSION['userId']);
}
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
  </head>
  <body>
  <?php include("includes/header.php"); ?>
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Trámites <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Trámites</h1>
          </div>
        </div>
      </div>
    </section>

<div class="s010  py-4">
    <form action="tramites.php" method="GET">
<div class="inner-form  col-md-6 offset-md-3">
<div class="basic-search ">
<div class="input-field">
<input id="search" type="text" placeholder="Buscar Tramite" name='buscar'>
<input type="text" hidden name = "numPag" value="1">

<div class="icon-wrap">
<button type="submit" value="numPag"  class="transparency-glass" >
<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24">
<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
</svg>
</div>

</div>
</div>
</form>
</div>


</div>



    <nav class="navbar navbar-default navbar-fixed-top">
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de tramites</h2>
      <?php if(isset($eliminado) and $eliminado == true ){?>
        <div class="alert alert-success" role="alert"> El tramite se ha eliminado exitosamente </div>
      <?php } ?>
			<hr />
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
      <?php if ($_SESSION['userRol']=='admin'){ ?>
				<tr>
          <th>Fecha</th>
          <th>Usuario</th>
          <th>Correo</th>
          <th class="iconos"><i class="fa fa-whatsapp icon-whats "></i></th>
          <th>Teléfono</th>
          <th>Mascota</th>
          <th>Especie</th>
          <th>Estado</th>
          
         
          <th>Acciones</th>
        

        </tr>
        <?php
          foreach($tramites as $tramite ){ ?>
						<tr>
              <td><?php echo $tramite->getFechaSolicitud(); ?></td>
							<td><a href="cliente.php?idUsuario=<?php echo $tramite->getIdUsuario()->getId() ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"><?php echo $tramite->getIdUsuario()->getNombre(); ?></span></a></td>
							<td><?php echo $tramite->getIdUsuario()->getCorreo(); ?></td>
							<td><a href="https://wa.me/52<?php echo $tramite->getIdUsuario()->getInfo()->getCelular();?>" target="_blank"><?php echo $tramite->getIdUsuario()->getInfo()->getCelular(); ?></a></td>
              <td><?php echo$tramite->getIdUsuario()->getInfo()->getTelefono(); ?></td>
              <td><a href="pet.php?idMascota=<?php echo $tramite->getIdMascota()->getId() ?>"><?php echo $tramite->getIdMascota()->getNombre();  ?></a></td>
              <td><?php echo $tramite->getIdMascota()->getEspecie();  ?></td>
              <td><?php echo $tramite->getEstado();  ?></td>
							
              <?php if ($_SESSION['userRol']=='admin'){ ?>
							<td>
              <form action="Tramite.php" method="POST">
								
                <a href="Tramite.php?idTramite=<?php echo $tramite->getId(); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><i class="fa fa-edit iconos-usuarios"></i></a>
              </form>

              </td>
              <?php }?>
						</tr>
            <?php
          } ?>
            <?php }?>

            <?php if ($_SESSION['userRol']=='cliente'){ ?>
				<tr>
          <th>Fecha</th>
          <th>Usuario</th>
          <th>Refugio Correo</th>
          <th class="iconos"><i class="fa fa-whatsapp icon-whats "></i></th>
         
          <th>Mascota</th>
          <th>Especie</th>
          <th>Estado</th>
          
         
          <th>Acciones</th>
        

        </tr>
        <?php
          foreach($tramites as $tramite ){ ?>
						<tr>
              <td><?php echo $tramite->getFechaSolicitud(); ?></td>
							<td><a href="formulario.php"><span class="glyphicon glyphicon-user" aria-hidden="true"><?php echo $tramite->getIdUsuario()->getNombre(); ?></span></a></td>
							<td>clanCanino@gmail.com</td>
							<td><a href="https://wa.me/52<?php echo $tramite->getIdMascota()->getIdRefugio()->getTelefono();?>" target="_blank"><?php echo $tramite->getIdUsuario()->getInfo()->getCelular(); ?></a></td>
              <td><a href="pet.php?idMascota=<?php echo $tramite->getIdMascota()->getId() ?>"><?php echo $tramite->getIdMascota()->getNombre();  ?></a></td>
              <td><?php echo $tramite->getIdMascota()->getEspecie();  ?></td>
              <td><?php echo $tramite->getEstado();  ?></td>
							
              
							<td>
              <form action="tramites.php" method="POST">
              <div class= 'row '>
              <div class="mx-2">
              <?php if ($_SESSION['userRol']=='cliente'){ ?>
                <input type="hidden" name="idTramite" value="<?php echo $tramite->getId(); ?>">  

                <button type="submit" value="delete" name="Eliminar"  onclick="return confirm('¿Seguro desea eliminar al el tramite? \nSi eliminas este tramite, se eliminaran todos los datos que esten vinculados a el.')" class="btn btn-danger btn-sm "> <i class="fa fa-trash iconos-usuarios"></i></button>
                </div>
                
               
                <?php }?>
              </form>

              </td>
             
						</tr>
            <?php
          } ?>
            <?php }?>
			</table>
			</div>
		</div>
	</div>

  </div>
                  <?php
                    include_once("includes/common_functions.php");
                    paginacion($pags, $pagina, $busqueda, "tramites.php?");
                  ?>
      </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

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