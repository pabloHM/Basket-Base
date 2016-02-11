<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$idclub=$_GET["idclub"];
	$titulo=$_GET["titulo"];
	$subtitulo=$_GET["subtitulo"];
	$cuerpo=$_GET["cuerpo"];
	$imagen=$_GET["imagen"];
	$start=$_GET["start"];
	$format=$_GET["format"];
	$where="";
	$limit="10";
	$condicion=false;
	if($id!=""){
		$where=$where."id='".$id."'";
		$condicion=true;
	}
	if($idclub!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idclub='".$idclub."'";
		$condicion=true;
	}
	if($titulo!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."titulo='".$titulo."'";
		$condicion=true;
	}
	if($subtitulo!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."subtitulo='".$subtitulo."'";
		$condicion=true;
	}
	if($cuerpo!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."cuerpo='".$cuerpo."'";
		$condicion=true;
	}
	if($imagen!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."imagen='".$imagen."'";
		$condicion=true;
	}

	if($condicion==true){
		if($start!=""){
			$res=mysqli_query($con, "SELECT * FROM tnoticias2 WHERE ".$where." ORDER BY id DESC LIMIT ".$start.", ".$limit)or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tnoticias2 WHERE ".$where." ORDER BY id DESC")or die("ERROR EN LA CONSULTA.");
		}
	}
	else{
		if($start!=""){
			$res=mysqli_query($con, "SELECT * FROM tnoticias2 ORDER BY id DESC LIMIT ".$start.", ".$limit)or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tnoticias2 ORDER BY id DESC")or die("ERROR EN LA CONSULTA.");
		}
	}
    while($row = mysqli_fetch_array($res)){
    	$resCl=mysqli_query($con, "SELECT nombre FROM tclubs2 WHERE id=".$row["idclub"])or die("ERROR EN NOMBRE CLUB.");
	    $rowCl = mysqli_fetch_assoc($resCl);
    	if($format=="text"){
	        $rowdata[]=array(
	        	"id"=>$row["id"],
	        	"idclub"=>utf8_encode($rowCl["nombre"]),
	        	"titulo"=>utf8_encode($row["titulo"]),
	        	"subtitulo"=>utf8_encode($row["subtitulo"]),
	        	"cuerpo"=>utf8_encode($row["cuerpo"]),
	        	"imagen"=>utf8_encode($row["imagen"])
	        );
    	}
    	else{
    		$rowdata[]=array(
	        	"id"=>$row["id"],
	        	"idclub"=>$row["idclub"],
	        	"titulo"=>utf8_encode($row["titulo"]),
	        	"subtitulo"=>utf8_encode($rowCl["nombre"])." - ".utf8_encode($row["subtitulo"]),
	        	"cuerpo"=>utf8_encode($row["cuerpo"]),
	        	"imagen"=>utf8_encode($row["imagen"])
	        );
    	}
    }
    
    if($condicion==true)
    	$resN=mysqli_query($con, "SELECT COUNT(*) FROM tnoticias2 WHERE ".$where)or die("ERROR CUENTA CONDICIÓN.");
    else
    	$resN=mysqli_query($con, "SELECT COUNT(*) FROM tnoticias2")or die("ERROR CUENTA.");
    $rowN = mysqli_fetch_assoc($resN);
    $rowdata[]=array("longitud"=>$rowN['COUNT(*)']);
	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>