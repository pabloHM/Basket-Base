<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$nombre=$_GET["nombre"];
	$idprovincia=$_GET["idprovincia"];
	$bb=$_GET["bb"];
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
	if($idprovincia!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idprovincia='".$idprovincia."'";
		$condicion=true;
	}
	if($bb!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."bb='".$bb."'";
		$condicion=true;
	}

	if($condicion==true){
		$res=mysqli_query($con, "SELECT * FROM tclubs2 WHERE ".$where." ORDER BY nombre")or die("ERROR EN LA CONSULTA.");
	}
	else{	
		$res=mysqli_query($con, "SELECT * FROM tclubs2 ORDER BY nombre")or die("ERROR EN LA CONSULTA.");
	}
    while($row = mysqli_fetch_array($res)){
        $rowdata[]=array(
        	"id"=>$row["id"],
        	"nombre"=>utf8_encode($row["nombre"]),
        	"bb"=>$row["bb"]
        );
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>