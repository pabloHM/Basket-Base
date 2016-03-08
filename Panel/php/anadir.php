<?php
	header("Content-Type: text/html;charset=utf-8");
	include "conn.php";
	session_start();

	$tabla="t".$_GET["tabla"];
	$editar=$_GET["editable"];
	$qry="";

	switch($tabla){
		case "tclubs":
			if($editar=='true'){
				$id=$_GET["id"];
				$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["name"])."', idprovincia=".$_POST["idprovincia"].", url='".$_POST["url"]."', bb=".$_POST["bb"]." WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(nombre, idprovincia, url, bb) VALUES ('".utf8_decode($_POST["name"])."', ".$_POST["idprovincia"].", '".$_POST["url"]."', ".$_POST["bb"].")";
		break;
		case "tequipos":
			if($editar=='true'){
				$id=$_GET["id"];
				$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["name"])."', idclub=".$_POST["idclub"].", idcategoria=".$_POST["idcategoria"]." WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(nombre, idclub, idcategoria) VALUES ('".utf8_decode($_POST["name"])."', ".$_POST["idclub"].", ".$_POST["idcategoria"].")";
		break;
		case "tpartidos":
			if($editar=='true'){
				$id=$_GET["id"];
				$qry="UPDATE ".$tabla."2 SET idequipo=".$_POST["idequipo"].", local='".utf8_decode($_POST["local"])."', visitante='".utf8_decode($_POST["vis"])."', fecha='".$_POST["fecha"]." ".$_POST["hora"]."' WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(idequipo, local, visitante, fecha) VALUES (".$_POST["idequipo"].", '".utf8_decode($_POST["local"])."', '".utf8_decode($_POST["vis"])."', '".$_POST["fecha"]." ".$_POST["hora"]."')";
		break;
		case "tmarcadores":
			if($editar=='true'){
				$id=$_GET["id"];
				$qry="UPDATE ".$tabla."2 SET ptsLocal=".$_POST["local"].", ptsVis=".$_POST["vis"]." WHERE idpartido='".$id."'";
			}
			else{
				$selectQRY="SELECT * FROM tmarcadores2 WHERE idpartido=".$_POST['idpartido'];
				$resMarc=mysqli_query($con, $selectQRY);
				if(mysqli_num_rows($resMarc)>0){
					$rowMarc=mysqli_fetch_assoc($resMarc);
					$id=$rowMarc['id'];
					$qry="UPDATE ".$tabla."2 SET ptsLocal=".$_POST["local"].", ptsVis=".$_POST["vis"]." WHERE id='".$id."'";
				}
				else{
					$qry="INSERT INTO ".$tabla."2(idpartido, ptsLocal, ptsVis) VALUES (".$_POST["idpartido"].", ".$_POST["local"].", ".$_POST["vis"].")";
				}
			}
		break;
		case "tusers":
			if($editar=='true'){
				$id=$_GET["id"];
				$editPass=$_GET["noPassEdit"];
				if($editPass!=1)
					$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["user"])."', pass='".md5($_POST["pass"])."', permiso='".$_POST["permiso"]."' WHERE id='".$id."'";
				else
					$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["user"])."', permiso='".$_POST["permiso"]."' WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(nombre, pass, permiso) VALUES ('".utf8_decode($_POST["user"])."', '".md5($_POST["pass"])."', '".$_POST["permiso"]."')";
		break;
		case "tnoticias":
			if($editar=='true'){
				$id=$_GET["id"];
				if($_POST["imagen"]!="")
					$qry="UPDATE ".$tabla."2 SET idclub=".$_POST["idclub"].", titulo='".utf8_decode($_POST["titulo"])."', subtitulo='".utf8_decode($_POST["subtitulo"])."', cuerpo='".utf8_decode($_POST["cuerpo"])."', imagen='".$_POST["imagen"]."' WHERE id='".$id."'";
				else
					$qry="UPDATE ".$tabla."2 SET idclub=".$_POST["idclub"].", titulo='".utf8_decode($_POST["titulo"])."', subtitulo='".utf8_decode($_POST["subtitulo"])."', cuerpo='".utf8_decode($_POST["cuerpo"])."' WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(idclub, titulo, subtitulo, cuerpo, imagen) VALUES (".$_POST["idclub"].", '".utf8_decode($_POST["titulo"])."', '".utf8_decode($_POST["subtitulo"])."', '".utf8_decode($_POST["cuerpo"])."', '".$_POST["imagen"]."')";
		break;
		case "tpatrocinadores":
			if($editar=='true'){
				$id=$_GET["id"];
				if($_POST["imagen"]!="")
					$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["nombre"])."', url='".$_POST["url"]."', ofertas=".$_POST["maxOfertas"].", imagen='".$_POST["imagen"]."' WHERE id='".$id."'";
				else
					$qry="UPDATE ".$tabla."2 SET nombre='".utf8_decode($_POST["nombre"])."', url='".$_POST["url"]."', ofertas=".$_POST["maxOfertas"]." WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(nombre, url, ofertas, imagen) VALUES ('".utf8_decode($_POST["nombre"])."', '".$_POST["url"]."', ".$_POST["maxOfertas"].", '".$_POST["imagen"]."')";
		break;
		case "tofertas":
			if($editar=='true'){
				$id=$_GET["id"];
				if($_POST["imagen"]!="")
					$qry="UPDATE ".$tabla."2 SET idpatro=".$_POST["idpatro"].", mensaje='".utf8_decode($_POST["mensaje"])."', url='".$_POST["url"]."', fechaFin='".$_POST["fechaFin"]."', imagen='".$_POST["imagen"]."' WHERE id='".$id."'";
				else
					$qry="UPDATE ".$tabla."2 SET idpatro=".$_POST["idpatro"].", mensaje='".utf8_decode($_POST["mensaje"])."', url='".$_POST["url"]."', fechaFin='".$_POST["fechaFin"]."' WHERE id='".$id."'";
			}
			else
				$qry="INSERT INTO ".$tabla."2(idpatro, mensaje, fechaFin, url, imagen) VALUES (".$_POST["idpatro"].", '".utf8_decode($_POST["mensaje"])."', '".$_POST["fechaFin"]."', '".$_POST["url"]."', '".$_POST["imagen"]."')";
		break;
	}

	//mysqli_query($con, $qry)or die($qry);
	echo true;
?>