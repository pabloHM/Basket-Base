<div id="title">Equipo</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='nameInput' class='form-group'>
		<label for='name'>Nombre*:</label>
		<input name='name' type='text' required id='name' class='form-control' placeholder='Introduce el nombre' maxlength="45">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='catInput' class='form-group'>
		<label for='cat'>Categoría*:</label>
		<select name="idcategoria" class="form-control" id="categoria">
		    <?php
				include '../php/conn.php';
				$qry="SELECT * FROM tcategorias";
				$res=mysqli_query($con, $qry)or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
        			echo "<option value='".$row['id']."'>".utf8_encode($row['nombre'])."</option>";
    			}
			?>
		</select>
	</div>
	<div id='clubInput' class='form-group'>
		<label for='club'>Club*:</label>
		<select name="idclub" class="form-control" id="club">
		    <?php
				include '../php/conn.php';
				$qry="SELECT * FROM tclubs2";
				$res=mysqli_query($con, $qry)or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
        			echo "<option value='".$row['id']."'>".utf8_encode($row['nombre'])."</option>";
    			}
			?>
		</select>
	</div>
	<p class="error" id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class="error" id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
	<button id='aceptar' type="submit" class="btn btn-primary">Aceptar</button>
	<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>
</form>