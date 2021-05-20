
<?php 
// Lógica de cierre de sesión
if(isset($_GET['logOff']) && $_GET['logOff'] == "true") {
    
    session_destroy();
	header('Cache-Control: no cache');
    header('Location: login.php?loggedOff=true');
  }

  //Lógica para obtención de datos del refugio para apartados generales
  include "Negocio/RefugioNegocio.php";
	getRefugio();
?>

<div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> <?php echo $_SESSION['refugioTelefono'];?></a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> clancanino.gym@gmail.com</a>
							

						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media">
							<p class="mb-0 d-flex">
								<a href="https://www.facebook.com/clanclaninoguaymas" target=" _blank" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
								<a href="https://www.instagram.com/clancanino/?hl=es-la&fbclid=IwAR1r7VNWZeZXoiVNfvFQUSKm-485eqt2ulckprqaPvrChkFhevzWKQ9dSqQ" target=" _blank" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							</p>
		        		</div>
					</div>
					
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light " id="ftco-navbar">
	    <div class="container ">
	    	<a class="navbar-brand" href="index.php"><span class="flaticon-pawprint-1 mr-2"></span>Clan canino</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
	        	<?php if( isset($_SESSION['userNombre']) and $_SESSION['userRol'] == "cliente"){ ?>
					<li class="nav-item"><a href="tramites.php" class="nav-link">Mis tramites</a></li>
			<?php }?>
			<li class="nav-item"><a href="refugio.php" class="nav-link">Refugio</a></li>
			<?php if( isset($_SESSION['userNombre']) and  $_SESSION['userRol'] == 'admin'){ ?>
			<li class="nav-item">
			
			<label for="btn-show1" class="nav-link" id="labelSubmenu">Admin<i class="fa fa-angle-down icono-desplega"> </i></label>
				<input type="checkbox" id="btn-show1" class="show-input">
				<ul class="submenu submenu1">
						<a href="tramites.php"  ><li class="nav-item children" > Tramites </li></a>
						<a href= "Usuarios.php" class="children"><li class="nav-item">Usuarios</li></a>
						<a href= "agregarMascota.php" class="children"><li class="nav-item">Agregar mascota</li></a> 

					</ul>
			 
			 </li> <?php }
			if( isset($_SESSION['userNombre'])){?>
				<li class="nav-item">
			
			<label for="btn-show2" class="nav-link" id="labelSubmenu">Mi PERFiL<i class="fa fa-angle-down icono-desplega"> </i></label>
				<input type="checkbox" id="btn-show2" class="show-input">
				<ul class="submenu submenu2">
						<a href="formulario.php"  ><li class="nav-item children" > Mis datos </li></a>
						<a href= "editarPerfil.php" class="children"><li class="nav-item">Configuración</li></a>
						<a href= "ayuda.php" class="children"><li class="nav-item">Ayuda</li></a>
						<a href= "index.php?logOff=true" class="children"><li class="nav-item">Cerrar sesión</li></a> 
					</ul>
		</li>
				<?php
				}else{?>
			 <li class= "nav-item"><a href="login.php" class="nav-link">Iniciar sesión</a></li>
				<?php }?>
	        </ul>
	      </div>
	    </div>
	  </nav>