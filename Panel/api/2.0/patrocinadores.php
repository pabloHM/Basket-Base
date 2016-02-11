<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$nombre=$_GET["nombre"];
	$url=$_GET["url"];
	$imagen=$_GET["imagen"];
	$ofertas=$_GET["ofertas"];
	$fecha=$_GET["fecha"];
	$clicks=$_GET["clicks"];
	$random=$_GET["random"];
	$where="";
	$condicion=false;
	if($id!=""){
		$where=$where."id='".$id."'";
		$condicion=true;
	}
	if($nombre!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."nombre='".$nombre."'";
		$condicion=true;
	}
	if($url!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."url='".$url."'";
		$condicion=true;
	}
	if($imagen!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."imagen='".$imagen."'";
		$condicion=true;
	}
	if($ofertas!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."max_ofertas='".$maxOfertas."'";
		$condicion=true;
	}
	if($fecha!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."fecha='".$fecha."'";
		$condicion=true;
	}
	if($clicks!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."clicks='".$clicks."'";
		$condicion=true;
	}

	if($condicion==true){
		if($random!=""){
			$res=mysqli_query($con, "SELECT * FROM tpatrocinadores2 ORDER BY RAND() LIMIT 1")or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tpatrocinadores2 WHERE ".$where." ORDER BY nombre")or die("ERROR EN LA CONSULTA.");
		}
	}
	else{
		if($random!=""){
			$res=mysqli_query($con, "SELECT * FROM tpatrocinadores2 ORDER BY RAND() LIMIT 1")or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tpatrocinadores2 ORDER BY nombre")or die("ERROR EN LA CONSULTA.");
		}
	}
    while($row = mysqli_fetch_array($res)){
        $rowdata[]=array(
        	"id"=>$row["id"],
        	"nombre"=>utf8_encode($row["nombre"]),
        	"url"=>$row["url"],
        	"imagen"=>$row["imagen"],
        	"ofertas"=>$row["ofertas"],
        	"fecha"=>$row["fecha"],
        	"clicks"=>$row["clicks"]
        );
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>