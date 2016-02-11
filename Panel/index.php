<!DOCTYPE html>
<html>
	<head lang='ES'>
		<title>BB Panel</title>
		<meta charset='UTF-8' />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="theme-color" content="#00BCD4"/>
		<link rel="icon" type="image/png" href="img/ic_launcher.png" size="192x192"/>
		<!--Librerías-->
		<link rel="stylesheet" type="text/css" href="lib/bootstrap.min.css">
		<script type="text/javascript" src='lib/jquery-1.11.3.min.js'></script>
		<script type="text/javascript" src='lib/bootstrap.min.js'></script>
		<!--Custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<!--Custom JS-->
		<script type="text/javascript" src='js/login.js'></script>
	</head>
	<body>
		<div id='loader'>
			<img src="img/loading.gif">
		</div>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
		<div id='content' class='col-md-6 col-sm-8 col-xs-10'>
			<div id='login' class='formulario'>
				<div id="title">BASKET BASE</div>
				<form autocomplete="on" role='form'>
					<div id='userInput' class='form-group'>
						<label for='user'>Usuario:</label>
						<input name='user' type='text' id='user' class='form-control' autocomplete="off" placeholder='Introduce tu usuario' maxlength="25">
						<p id="userError" class='error'>Debe contener entre 4-25 caracteres.</p>
					</div>
					<div id='passInput' class='form-group'>
						<label for='pass'>Contraseña:</label>
						<input name='pass' type='password' id='pass' class='form-control' autocomplete="off" placeholder='Introduce la contraseña' maxlength="15">
						<p id="passError" class='error'>Debe contener al menos un número y entre 6-15 caracteres.</p>
					</div>
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" id='saveCheck'>Recordar contraseña
					    </label>
					</div>
					<div id='loginError' class='error'>Hubo un error en los datos introducidos.</div>
					<div id='bdError' class='error'>Hubo un error en la conexión a la base de datos. Disculpe las molestias.</div>
					<div id="enviar"><button id='login' type="submit" class="btn btn-success">Enviar</button></div>
				</form>
			</div>
		</div>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
	</body>
</html>