<div id="title">Club</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='nameInput' class='form-group'>
		<label for='name'>Nombre*:</label>
		<input name='name' type='text' id='name' class='form-control' placeholder='Introduce el nombre' maxlength="200">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='provinciaInput' class='form-group'>
		<label for='provincia'>Provincia*:</label>
		<select name="idprovincia" class="form-control" id="provincia">
		    <?php
				include '../php/conn.php';
				$qry="SELECT * FROM tprovincias";
				$res=mysqli_query($con, $qry)or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
        			echo "<option value='".$row['id']."'>".utf8_encode($row['nombre'])."</option>";
    			}
			?>
		</select>
	</div>
	<div id='urlInput' class='form-group'>
		<label for='url'>URL:</label>
		<input name='url' type='text' id='url' class='form-control' placeholder='Introduce la url' maxlength="255">
	</div>
	<div id='bbInput' class='form-group'>
		<label for='bb'>Basket Base?:</label>
		<input name="bb" id="bbSi" type="radio" value="true">Si
		<input name="bb" id="bbNo" type="radio" value="false" checked>No
	</div>
	<p class="error" id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class="error" id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
	<button id='aceptar' type="submit" class="btn btn-success">Aceptar</button>
	<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>
</form>