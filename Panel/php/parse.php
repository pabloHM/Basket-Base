<?php
	header("Content-Type: text/html;charset=utf-8");
	$rowP="";
	$rowM="";
	$rowE="";
	$rowC="";
	if($_POST['idpartido']!=""){
		include "conn.php";
		$resP=mysqli_query($con, "SELECT * FROM tpartidos2 WHERE id='".$_POST["idpartido"]."'")or die("ERROR EN LA CONSULTA");
		$resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido='".$_POST["idpartido"]."'")or die("ERROR EN LA CONSULTA");
		$rowP=mysqli_fetch_assoc($resP);
		$rowM=mysqli_fetch_assoc($resM);
		$resE=mysqli_query($con, "SELECT * FROM tequipos2 WHERE id='".$rowP["idequipo"]."'")or die("ERROR EN LA CONSULTA");
		$rowE=mysqli_fetch_assoc($resE);
		$resC=mysqli_query($con, "SELECT * FROM tcategorias WHERE id='".$rowE["idcategoria"]."'")or die("ERROR EN LA CONSULTA");
		$rowC=mysqli_fetch_assoc($resC);
	}

	$url = 'https://api.parse.com/1/push';
	$appId = 'vN625mbIaAK5u0H49DUIZyQxq7o4zMaEoG8ggnpH';
	$restKey = 'Ry4T9vumYASCtt3mHgnx82B5xjjS7LIXvwZ5WozE';

	$mensaje="";
	$titulo="";
	$modal=$_POST['modal'];
	$imagen="";
	$catNom="";

	if($modal=="ofertas"){
		$mensaje=utf8_encode(str_replace("\r", "",$_POST['message']));
		$titulo=utf8_encode($_POST['title']);
		$imagen=$_POST['imagen'];
		$catNom=$_POST['catNom'];
		$idNom=$rowP["idequipo"];
	}
	else{
		$mensaje=$rowP['local']." ".$rowM['ptsLocal']." - ".$rowM['ptsVis']." ".$rowP['visitante'];
		$titulo="Resultado ".utf8_encode($rowC['nombre']);
		$imagen="";
		$catNom=utf8_encode($rowE['nombre']).utf8_encode($rowC['nombre']);
		$idNom=$rowP["idequipo"];
	}

	$push_payload = json_encode(array(
	 		'where' => '{}',
	        "data" => array(
	                "alert" => $mensaje,
	                "title" => $titulo,
	                "modal" => $modal,
	                "imagen" => $imagen,
	                "catNom"=> $catNom,
	                "idNom"=> $idNom
	        )
	));
	print_r($push_payload);
	$rest = curl_init();
	curl_setopt($rest,CURLOPT_URL,$url);
	curl_setopt($rest,CURLOPT_PORT,443);
	curl_setopt($rest,CURLOPT_POST,1);
	curl_setopt($rest,CURLOPT_POSTFIELDS,$push_payload);
	curl_setopt($rest,CURLOPT_HTTPHEADER,
	        array("X-Parse-Application-Id: " . $appId,
	                "X-Parse-REST-API-Key: " . $restKey,
	                "Content-Type: application/json"));

	$response = curl_exec($rest);
	echo $response;
?>