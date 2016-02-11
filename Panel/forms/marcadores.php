<div id="title"></div>
<form autocomplete="on" role='form' id="formulario">
	<div id='hideInput' class='form-group' style="display: none">
		<input name='idpartido' type='text' id='idpartido'>
	</div>
	<div id='localInput' class='form-group'>
		<label for='local'>Local:</label>
		<input name='local' type='number' required id='local' class='form-control' maxlength='3'>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='visInput' class='form-group'>
		<label for='vis'>Visitante:</label>
		<input name='vis' type='number' required id='vis' class='form-control' maxlength='3'>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<p class="error" id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class="error" id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
	<button id='aceptar' type="submit" class="btn btn-primary">Aceptar</button>
	<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>
</form>