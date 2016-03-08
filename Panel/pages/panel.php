<!DOCTYPE html>
<html>
	<head lang='ES'>
		<title>BB Panel</title>
		<meta charset='UTF-8' />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="theme-color" content="#00BCD4"/>
		<link rel="icon" type="image/png" href="../img/ic_launcher.png" size="192x192"/>
		<!--Librerías-->
		<link rel="stylesheet" type="text/css" href="../lib/bootstrap.min.css">
		<script type="text/javascript" src='../lib/jquery-1.11.3.min.js'></script>
		<script type="text/javascript" src='../lib/bootstrap.min.js'></script>
		<!--Custom CSS -->
		<link rel="stylesheet" type="text/css" href="../css/styles.css">
		<link rel="stylesheet" type="text/css" href="../css/panel.css">
		<!--Custom JS-->
		<script type="text/javascript" src='../js/panel.js'></script>
		<script type="text/javascript" src='../js/permisos.js'></script>
	</head>
	<body>
		<div id='loader'>
			<img src="../img/loading.gif">
		</div>
		<?php
			session_start();
			if(isset($_SESSION['tiempo']) && $_SESSION['recordar']=='false'){
				$ahora=date("Y-m-d H:i:s");
				$diffTiempo=strtotime($ahora)-strtotime($_SESSION['tiempo']);
				if($diffTiempo>28800){
					session_destroy();
					header("Location: http://bbpanel.advalleinclan.es");
				}
			}
			if(isset($_SESSION['uName'])){
		?>
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
  					<a class="navbar-brand" href="/pages/panel">Basket Base</a>
				</div>
				<div class='navbar-user'>
					¡Bienvenido, <span class='nameUser' permiso="<?=$_SESSION['permiso'];?>" iduser='<?=$_SESSION['id'];?>'><?php echo $_SESSION['uName']?></span>!<br>
					<a id='logout' href='../'>Salir</a>
				</div>
			</div>
		</nav>
		<div class='col-md-2 col-sm-2 col-xs-1'></div>
		<div id='content' class='col-md-8 col-sm-8 col-xs-10'>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='clubs'>
				<div class='imagen'><img src='../img/rugby85.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir club</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar club</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar club</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='equipos'>
				<div class='imagen'><img src='../img/inflatable.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir equipo</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar equipo</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar equipo</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='partidos'>
				<div class='imagen'><img src='../img/ball68.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir partido</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar partido</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar partido</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='marcadores'>
				<div class='imagen'><img src='../img/rugby68.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir marcador</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar marcador</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6 admin' id='users'>
				<div class='imagen'><img src='../img/profile27.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir usuario</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar usuario</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar usuario</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='noticias'>
				<div class='imagen'><img src='../img/newspaper1.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir noticia</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar noticia</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar noticia</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='patrocinadores'>
				<div class='imagen'><img src='../img/lace19.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir patrocinador</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar patrocinador</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar patrocinador</button></div>
			</div>
			<div class='tabla col-lg-2 col-md-3 col-sm-5 col-xs-6' id='ofertas'>
				<div class='imagen'><img src='../img/sales4.png'/></div>
				<div class='boton'><button class='btn btn-primary anadir'>Añadir oferta</button></div>
				<div class='boton'><button class='btn btn-warning editar'>Editar oferta</button></div>
				<div class='boton'><button class='btn btn-danger borrar'>Borrar oferta</button></div>
			</div>
		</div>
		<div class='col-md-2 col-sm-2 col-xs-1'></div>
		<?php
			}
			else
				header("Location: /");
		?>
	</body>
</html>