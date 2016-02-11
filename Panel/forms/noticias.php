<div id="title">Noticia</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='clubInput' class='form-group'>
		<label for='club'>Club*:</label>
		<select name="idclub" class="form-control" id="club">
		    <?php
				include '../php/conn.php';
				$qry="SELECT * FROM tclubs2 WHERE bb=1";
				$res=mysqli_query($con, $qry)or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
        			echo "<option value='".$row['id']."'>".utf8_encode($row['nombre'])."</option>";
    			}
			?>
		</select>
	</div>
	<div id='tituloInput' class='form-group'>
		<label for='titulo'>Título:</label>
		<input name='titulo' type='text' required id='titulo' class='form-control' maxlength='100'>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='subtituloInput' class='form-group'>
		<label for='subtitulo'>Subtítulo:</label>
		<input name='subtitulo' type='text' required id='subtitulo' class='form-control' maxlength='250'>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='cuerpoInput' class='form-group'>
		<label for='cuerpo'>Cuerpo:</label>
		<textarea name='cuerpo' type='text' required id='cuerpo' class='form-control' maxlength='8000'></textarea>
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<p class="error" id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class="error" id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
</form>
<form subido="false" id="imgForm" method="post" enctype="multipart/form-data">
	<label for='imagen'>Imagen:</label>
	<input name='imagen' type='file' id='imagen' class='form-control'>
	<button id='subir' type="submit" class="btn btn-warning">Subir</button>
	<p class="error" id='errorSubida'>Error al subir la imagen. Inténtelo de nuevo</p>
</form>
<button id='aceptar' type="submit" class="btn btn-primary">Aceptar</button>
<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>