<?php
	include "conn.php";
	define('API_ACCESS_KEY', 'AIzaSyAjDMZJT_uwoCZdYl5dXRx5R10GHEODu4s');

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

	$mensaje="";
	$titulo="";
	$modal=$_POST['modal'];
	$imagen="";
	$catNom="";

	if($modal=="ofertas" || $modal=="pruebas"){
		$mensaje=str_replace("\r", "",$_POST['message']);
		$titulo=$_POST['title'];
		$imagen=$_POST['imagen'];
		$idNom="";
	}
	else{
		$mensaje=$rowP['local']." ".$rowM['ptsLocal']." - ".$rowM['ptsVis']." ".$rowP['visitante'];
		$titulo="Resultado ".$rowC['nombre'];
		$imagen="";
		$idNom=$rowP["idequipo"];
	}

	$msg = array(
		"message" => $mensaje,
        "title" => $titulo,
        "modal" => $modal,
        "imagen" => $imagen,
        "idNom"=> $idNom
	);

	$ids=array();
	$resIds=mysqli_query($con, "SELECT * FROM gcm");
	while($row = mysqli_fetch_array($resIds)){
        $ids[]=$row["registration_id"];
    }
	
	$fields = array(
		"registration_ids" => $ids,
		'data'	=> $msg
	);
 
	$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
	);
	 
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt($rest,CURLOPT_PORT,443);
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );

	if (curl_errno($ch)){
        echo 'GCM error: '.curl_error($ch);
    }

	echo $result;
?>