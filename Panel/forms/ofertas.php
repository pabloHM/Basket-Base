<div id="title">Oferta</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='patroInput' class='form-group'>
		<label for='patro'>Patrocinador*:</label>
		<select name='idpatro' id='idpatro' style='margin-left: 10px'>
			<?php
				include '../php/conn.php';
				$qry="SELECT id, nombre FROM tpatrocinadores2";
				$res=mysqli_query($con, $qry)or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
        			echo "<option value='".$row['id']."'>".utf8_encode($row['nombre'])."</option>";
    			}
			?>
		</select>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='mensajeInput' class='form-group'>
		<label for='mensaje'>Mensaje*:</label>
		<textarea name='mensaje' type='text' required id='mensaje' class='form-control' maxlength='500'></textarea>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='fechaFinInput' class='form-group'>
		<label for='fechaFin'>Fecha Fin*:</label>
		<input name='fechaFin' type='date' required id='fechaFin' class='form-control'>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='urlInput' class='form-group'>
		<label for='url'>Url:</label>
		<input name='url' type='text' required id='url' class='form-control' maxlength='255'>
	</div>
	<p class='error' id='errorOfertas'>No puedes añadir más ofertas.</p>
	<p class='error' id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class='error' id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
</form>
<form subido="false" id="imgForm" method="post" enctype="multipart/form-data">
	<label for='imagen'>Imagen:</label>
	<input name='imagen' type='file' id='imagen' class='form-control'>
	<button id='subir' type="submit" class="btn btn-warning">Subir</button>
	<p class='error' id='errorSubida'>Error al subir la imagen. Inténtelo de nuevo</p>
</form>
<button id='aceptar' type="submit" class="btn btn-primary">Aceptar</button>
<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>