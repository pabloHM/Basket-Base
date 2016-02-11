<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$nombre=$_GET["nombre"];
	$club=$_GET["club"];
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
	if($club!=""){
		if($condicion==true){
			$res=mysqli_query($con, "SELECT * FROM tprovincias WHERE ".$where." AND id IN(SELECT idprovincia FROM tclubs2 WHERE bb=1)")or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tprovincias WHERE id IN(SELECT idprovincia FROM tclubs2 WHERE bb=1)")or die("ERROR EN LA CONSULTA.");
		}
	}
	else{
		if($condicion==true){
			$res=mysqli_query($con, "SELECT * FROM tprovincias WHERE ".$where)or die("ERROR EN LA CONSULTA.");
		}
		else{
			$res=mysqli_query($con, "SELECT * FROM tprovincias")or die("ERROR EN LA CONSULTA.");
		}
	}
    while($row = mysqli_fetch_array($res)){
        $rowdata[]=array(
        	"id"=>$row["id"],
        	"nombre"=>utf8_encode($row["nombre"])
        );
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>