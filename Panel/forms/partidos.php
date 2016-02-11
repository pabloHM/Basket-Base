<div id="title">Partido</div>
<form autocomplete="on" role='form' id="formulario">
	<div id='hideInput' class='form-group' style="display: none">
		<input name='idequipo' type='text' id='idequipo'>
	</div>
	<div id='localInput' class='form-group'>
		<label for='local'>Equipo local*:</label><br>
		<select id='selectLocal' style='margin-bottom: 10px'>
			<option selected idequipo="0">Ninguno</option>
			<?php
				include '../php/conn.php';
				$res=mysqli_query($con, "SELECT * FROM tequipos2")or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
					$resC=mysqli_query($con, "SELECT * FROM tcategorias WHERE id=".$row["idcategoria"])or die("Error al obtener los datos.");
        			$rowC = mysqli_fetch_assoc($resC);
        			echo "<option idequipo='".$row['id']."'>".utf8_encode($row['nombre'])." - ".utf8_encode($rowC['nombre'])."</option>";
    			}
			?>
		</select>
		<input name='local' type='text' required id='local' class='form-control' placeholder='Introduce el nombre del equipo local:' maxlength="45">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='visInput' class='form-group'>
		<label for='vis'>Equipo visitante*:</label><br>
		<select id='selectVis' style='margin-bottom: 10px'>
			<option selected idequipo="0">Ninguno</option>
			<?php
				include '../php/conn.php';
				$res=mysqli_query($con, "SELECT * FROM tequipos2")or die("Error al obtener los datos.");
				while($row = mysqli_fetch_array($res)){
					$resC=mysqli_query($con, "SELECT * FROM tcategorias WHERE id=".$row["idcategoria"])or die("Error al obtener los datos.");
        			$rowC = mysqli_fetch_assoc($resC);
        			echo "<option idequipo='".$row['id']."'>".utf8_encode($row['nombre'])." - ".utf8_encode($rowC['nombre'])."</option>";
    			}
			?>
		</select>
		<input name='vis' type='text' required id='vis' class='form-control' placeholder='Introduce el nombre del equipo visitante:' maxlength="45">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='fechaInput' class='form-group'>
		<label for='fecha'>Fecha del partido*:</label>
		<input name='fecha' type='date' required id='fecha' class='form-control' maxlength="10">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<div id='horaInput' class='form-group'>
		<label for='hora'>Hora del partido*:</label>
		<input name='hora' type='text' required id='hora' class='form-control' placeholder='hh:mm' maxlength="5">
		<p class='error' style='display:none'>No puede quedar vacío</p>
	</div>
	<p class='error' id='errorDatos'>Cubre los datos obligatorios.</p>
	<p class='error' id='errorAnadir'>Error en la conexión a la base de datos. Si el error persiste, ponte en contacto con el administrador de la web.</p>
	<button id='aceptar' type="submit" class="btn btn-primary">Aceptar</button>
	<button id='cancelar' class="btn btn-danger" onclick="history.back()">Cancelar</button>
</form>