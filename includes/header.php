
<?php 
// Lógica de cierre de sesión
if(isset($_GET['logOff']) && $_GET['logOff'] == "true") {
    
    session_destroy();
	header('Cache-Control: no cache');
    header('Location: login.php?loggedOff=true');
  }
?>
<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> 6221542314</a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> perla.duran12@gmail.com</a>
							

						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media">
							<p class="mb-0 d-flex">
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
								<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
							</p>
		        		</div>
					</div>
					
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="index.php"><span class="flaticon-pawprint-1 mr-2"></span>Clan canino</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
	        	
	          <li class="nav-item"><a href="editarPerfil.php" class="nav-link">Perfil</a></li>
			  <li class="nav-item"><a href="refugio.php" class="nav-link">Refugio</a></li>
			 <?php if( isset($_SESSION['userNombre']) and  $_SESSION['userRol'] == 'admin'){ ?>
			 <li class="nav-item">
			 
			 <label for="btn-show" class="nav-link">Admin<i class="fa fa-angle-down icono-desplega"> </i></label>
				<input type="checkbox" id="btn-show" class="show-input">
				<ul class="submenu">
						<a href="tramites.php" ><li class="nav-item"> Tramites </li></a>
						<a href= "Usuarios.php"><li class="nav-item">Usuarios</li></a>
						<a href= "agregarMascota.php"><li class="nav-item">Agregar mascota</li></a> 

					</ul>
			 
			 </li> <?php }?>
			  <li class= "nav-item"><a href="?logOff=true" class="nav-link">Cerrar Sesión</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>