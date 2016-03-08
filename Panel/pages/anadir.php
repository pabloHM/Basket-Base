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
		<!--Custom JS-->
		<script type="text/javascript" src='../js/anadir.js'></script>
		<script type="text/javascript" src='../js/previoAnadir.js'></script>
		<script type="text/javascript" src='../js/test_registro.js'></script>
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
					header("Location: /");
				}
			}
			if(isset($_SESSION['uName'])){
		?>
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
  					<a class="navbar-brand" href="../pages/panel">Basket Base</a>
				</div>
				<div class='navbar-user'>
					¡Bienvenido, <span class='nameUser' permiso="<?=$_SESSION['permiso'];?>" iduser='<?=$_SESSION['id'];?>'><?php echo $_SESSION['uName']?></span>!<br>
					<a id='logout' href='../index.php'>Salir</a>
				</div>
			</div>
		</nav>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
		<div id='content' class='col-md-6 col-sm-8 col-xs-10'>
			<div class="formulario"></div>
		</div>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
		<?php
			}
			else
				header("Location: /");
		?>
	</body>
</html>