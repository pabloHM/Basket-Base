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
		<script type="text/javascript" src='../js/lista.js'></script>
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
  					<a class="navbar-brand" href="../">Basket Base</a>
				</div>
				<div class='navbar-user'>
					¡Bienvenido, <span class='nameUser' permiso="<?=$_SESSION['permiso'];?>" iduser='<?=$_SESSION['id'];?>'><?php echo $_SESSION['uName']?></span>!<br>
					<a id='logout' href='../index.php'>Salir</a>
				</div>
			</div>
		</nav>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
		<div id='content' class='col-md-6 col-sm-8 col-xs-10'>
			<p><b>Selecciona un elemento:</b></br></p>
			<div id='listaEquipos' class='list-group'>
				<?php 
					include '../php/conn.php';
					$tabla=$_GET["tabla"];
					$borrable=$_GET["borrable"];

					switch($tabla){
						case "provincias":
							$sw=$_GET["sw"];
							$qry="SELECT * FROM tprovincias WHERE id IN(SELECT idprovincia FROM tclubs2)";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								echo "<a tabla='".$tabla."' href='listar.php?tabla=clubs&editable=true&borrable=".$borrable."&id=".$row['id']."&sw=".$sw."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
							}
						break;
						case "clubs":
							$sw=$_GET["sw"];
							$qry="SELECT * FROM tclubs2 WHERE idprovincia='".$_GET["id"]."'";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								if($sw=="0")
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
								else if($sw=="9")
									echo "<a tabla='".$tabla."' href='listar.php?tabla=noticias&editable=true&borrable=".$borrable."&id=".$row['id']."&sw=".($sw-1)."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
								else
									echo "<a tabla='".$tabla."' href='listar.php?tabla=equipos&editable=true&borrable=".$borrable."&id=".$row['id']."&sw=".($sw-1)."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
							}
						break;
						case "equipos":
							$sw=$_GET["sw"];
							$qry="SELECT * FROM tequipos2 WHERE idclub='".$_GET["id"]."'";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								$qryC = "SELECT * FROM tcategorias WHERE id='".$row["idcategoria"]."'";
								$resC = mysqli_query($con, $qryC)or die($qryC);
								$rowC = mysqli_fetch_assoc($resC);
								if($sw=="0")
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["nombre"])." - ".utf8_encode($rowC["nombre"])."</a>";
								else
									echo "<a tabla='".$tabla."' href='listar.php?tabla=partidos&editable=true&borrable=".$borrable."&id=".$row['id']."&sw=".($sw-1)."' class='list-group-item'>".utf8_encode($row["nombre"])." - ".utf8_encode($rowC["nombre"])."</a>";
							}
						break;
						case "partidos":
							$sw=$_GET["sw"];
							if($sw=="0")
								$qry="SELECT * FROM tpartidos2 WHERE idequipo='".$_GET["id"]."'";
							else if($sw=="1")
								$qry="SELECT * FROM tpartidos2 WHERE idequipo='".$_GET["id"]."' AND id NOT IN(SELECT idpartido FROM tmarcadores2)";
							else
								$qry="SELECT p.id, m.id as idM, idpartido, ptsLocal, ptsVis, local, visitante FROM tpartidos2 p, tmarcadores2 m WHERE idequipo='".$_GET["id"]."' AND p.id=idpartido";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								if($sw=="0")
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["local"])." - ".utf8_encode($row["visitante"])."</a>";
								else if($sw=="1")
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=marcadores&editable=false&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["local"])." - ".utf8_encode($row["visitante"])."</a>";
								else
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=marcadores&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["local"])." - ".utf8_encode($row["visitante"])."</a>";
							}
						break;
						case "users":
							$qry="SELECT * FROM tusers2";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
							}
						break;
						case "noticias":
							$qry="SELECT * FROM tnoticias2 WHERE idclub='".$_GET["id"]."'";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["titulo"])."</a>";
							}
						break;
						case "patrocinadores":
							$sw=$_GET["sw"];
							$qry="SELECT * FROM tpatrocinadores2";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								if($sw=="1")
									echo "<a tabla='".$tabla."' href='listar.php?tabla=ofertas&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
								else
									echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["nombre"])."</a>";
							}
						break;
						case "ofertas":
							$qry="SELECT * FROM tofertas2 WHERE idpatro='".$_GET["id"]."'";
							$res=mysqli_query($con, $qry);
							while($row=mysqli_fetch_array($res)){
								echo "<a tabla='".$tabla."' href='anadir.php?tabla=".$tabla."&editable=true&borrable=".$borrable."&id=".$row['id']."' class='list-group-item'>".utf8_encode($row["mensaje"])."</a>";
							}
						break;
					}
				?>
				<button id="volver" class="btn btn-info" onclick="history.back()">Volver</button>
			</div>

			<div id='myModal' class="modal fade">
		  	<div class="modal-dialog">
		    	<div class="modal-content">
		      		<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title">Eliminar</h4>
		      		</div>
			      	<div class="modal-body">
			        	<p>¿Estás seguro de eliminar este elemento?</p>
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        	<button type="button" class="btn btn-danger" id='botonBorrar'>Borrar</button>
			      	</div>
		    	</div>
			</div>
		</div>
		</div>
		<div class='col-md-3 col-sm-2 col-xs-1'></div>
		<?php
			}
			else
				header("Location: /");
		?>
	</body>
</html>