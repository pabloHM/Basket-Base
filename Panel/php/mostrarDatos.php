<?php
	include '../php/conn.php';
	session_start();
	$modal = $_POST['modal'];
	$id = $_POST['id'];
	$qry="";
	if($modal=="marcadores")
		$qry="SELECT * FROM t".$modal."2 WHERE idpartido=".$id;
	else
		$qry="SELECT * FROM t".$modal."2 WHERE id=".$id;
	
	$res=mysqli_query($con, $qry)or die($qry);
	switch($modal){
		case 'clubs':
			$row = mysqli_fetch_assoc($res);
			echo "id:".$row["id"]."+nombre:".utf8_encode($row["nombre"])."+idprovincia:".$row["idprovincia"]."+url:".$row["url"]."+bb:".$row["bb"];
		break;
		case 'categorias':
			$row = mysqli_fetch_assoc($res);
			echo "id:".$row["id"]."+nombre:".utf8_encode($row["nombre"]);
		break;
		case 'equipos':
			$row = mysqli_fetch_assoc($res);
			$qryC = "SELECT * FROM tcategorias WHERE id='".$row["idcategoria"]."'";
			$resC = mysqli_query($con, $qryC)or die($qryC);
			$rowC = mysqli_fetch_assoc($resC);
			echo "nombre:".utf8_encode($row["nombre"])."+idcat:".$row["idcategoria"]."+idclub:".$row["idclub"];
		break;
		case 'partidos':
			$row = mysqli_fetch_assoc($res);
			echo "idequipo:".$row["idequipo"]."+local:".utf8_encode($row["local"])."+visitante:".utf8_encode($row["visitante"])."+fecha:".$row["fecha"];
		break;
		case 'marcadores':
			$row = mysqli_fetch_assoc($res);
			echo "ptsLocal:".$row["ptsLocal"]."+ptsVis:".$row["ptsVis"];
		break;
		case 'users':
			$row = mysqli_fetch_assoc($res);
			echo "nombre:".$row["nombre"]."+pass:".$row["pass"]."+permiso:".$row["permiso"];
		break;
		case 'noticias':
			$row = mysqli_fetch_assoc($res);
			echo "idclub:".$row["idclub"]."+titulo:".utf8_encode($row["titulo"])."+subtitulo:".utf8_encode($row["subtitulo"])."+cuerpo:".utf8_encode($row["cuerpo"]);
		break;
		case 'patrocinadores':
			$row = mysqli_fetch_assoc($res);
			echo "nombre:".utf8_encode($row["nombre"])."+url:".$row["url"]."+imagen:".$row["imagen"]."+ofertas:".$row["ofertas"];
		break;
		case 'ofertas':
			$row = mysqli_fetch_assoc($res);
			$qryP="SELECT nombre FROM tpatrocinadores2 WHERE id=".$row["idpatro"];
			$resP=mysqli_query($con, $qryP)or die($qryP);
			$rowP = mysqli_fetch_assoc($resP);
			echo "idpatro:".$row["idpatro"]."+npatro:".$rowP["empresa"]."+mensaje:".utf8_encode($row["mensaje"])."+fechaFin:".$row["fechaFin"]."+url:".$row["url"];
		break;
		default:
			echo "ERROR LOADING DATA";
	}
?>