<div id="title">Usuario</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='userInput' class='form-group'>
		<label for='user'>Usuario*:</label>
		<input name='user' type='text' required id='user' class='form-control' placeholder='Introduce tu usuario.' maxlength="20">
		<p class='error' style='display: none'>Debe contener entre 4-20 caracteres.</p>
	</div>
	<div id='passInput' class='form-group'>
		<label for='pass'>Contraseña*:</label>
		<input name='pass' type='password' required id='pass' class='form-control' placeholder='Introduce la contraseña.' maxlength="15">
		<p class='error' style='display: none'>Debe contener al menos un número y entre 6-15 caracteres.</p>
	</div>
	<div id='passRepetInput' class='form-group'>
		<label for='passRepet'>Repite la contraseña*:</label>
		<input name='passRepet' type='password' required id='passRepet' class='form-control' placeholder='Introduce la contraseña.' maxlength="15">
		<p class='error' style='display: none'>No coinciden las contraseñas.</p>
	</div>
	<button id='generaPass' class="btn btn-warning" style="margin-bottom: 10px">Generar contraseña aleatoria</button>
	<span id="passGenerada"></span>
	<div id='permisoInput' class='form-group'>
		<label for='permiso'>Permiso*:</label>
		<select name="permiso" class="form-control" id="permiso">
		    <option value="U">Usuario</option>
		    <option value="A">Administrador</option>
		    <option value="S">Sponsor</option>
		</select>
	</div>
	<p id='errorDatos' style='display: none'>Cubre los datos obligatorios correctamente.</p>
	<p id='errorAnadir' style='display: none'>Error en la conexión a la base de datos.</p>
	<button id='aceptar' class="btn btn-primary">Registrar</button>
	<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>
</form>