<div id="title">Patrocinadores</div>
<form autocomplete="on" role='form' id='formulario'>
	<div id='nombreInput' class='form-group'>
		<label for='nombre'>Empresa:</label>
		<input name='nombre' type='text' id='nombre' class='form-control' maxlength='70'>
		<p class='error'>No puede quedar vacío</p>
	</div>
	<div id='urlInput' class='form-group'>
		<label for='url'>Url:</label>
		<input name='url' type='text' id='url' class='form-control' maxlength='255'>
		<p class='error'>No puede quedar vacío</p>
	</div>
	<div id='maxOfertasInput' class='form-group'>
		<label for='maxOfertas'>Ofertas:</label>
		<input name='maxOfertas' type='number' id='maxOfertas' class='form-control' maxlength='10'>
		<p class='error'>No puede quedar vacío</p>
	</div>
	<p class='error' id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class='error' id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
</form>

<form subido="false" id="imgForm" method="post" enctype="multipart/form-data">
	<label for='imagen'>Imagen:</label>
	<input name='imagen' type='file' id='imagen' class='form-control'>
	<button id='subir' type="submit" class="btn btn-warning">Subir</button>
	<p class='error' id='errorSubida'>Error al subir la imagen. Inténtelo de nuevo</p>
</form>

<button id='aceptar' type="submit" class="btn btn-primary" disabled>Aceptar</button>
<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>