<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$nombre=$_GET["nombre"];
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

	if($condicion==true){
		$res=mysqli_query($con, "SELECT * FROM tcategorias WHERE ".$where)or die("ERROR EN LA CONSULTA.");
	}
	else{
		$res=mysqli_query($con, "SELECT * FROM tcategorias")or die("ERROR EN LA CONSULTA.");
	}
    while($row = mysqli_fetch_array($res)){
        $rowdata[]=array(
        	"id"=>$row["id"],
        	"nombre"=>utf8_encode($row["nombre"])
        );
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>