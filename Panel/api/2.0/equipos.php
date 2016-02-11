<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$nombre=$_GET["nombre"];
	$idclub=$_GET["idclub"];
	$idcategoria=$_GET["idcat"];
	$format=$_GET["format"];
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
	if($idclub!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idclub='".$idclub."'";
		$condicion=true;
	}
	if($idcategoria!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idcategoria='".$idcategoria."'";
		$condicion=true;
	}

	if($condicion==true){
		$res=mysqli_query($con, "SELECT tequipos2.id, tequipos2.idcategoria, tequipos2.nombre, tequipos2.idclub FROM tequipos2, tcategorias WHERE ".$where." AND tequipos2.idcategoria=tcategorias.id ORDER BY tcategorias.orden")or die("ERROR EN LA CONSULTA.");
	}
	else{	
		$res=mysqli_query($con, "SELECT * FROM tequipos2")or die("ERROR EN LA CONSULTA.");
	}
    while($row = mysqli_fetch_array($res)){
    	if($format=="text"){
    		$resCa=mysqli_query($con, "SELECT nombre FROM tcategorias WHERE id=".$row["idcategoria"])or die("ERROR EN LA CONSULTA.");
	        $rowCa = mysqli_fetch_assoc($resCa);
	        $resCl=mysqli_query($con, "SELECT nombre FROM tclubs2 WHERE id=".$row["idclub"])or die("ERROR EN LA CONSULTA.");
	        $rowCl = mysqli_fetch_assoc($resCl);
	        $rowdata[]=array(
	        	"id"=>$row["id"],
	        	"nombre"=>utf8_encode($row["nombre"]),
	        	"categoria"=>utf8_encode($rowCa["nombre"]),
	        	"club"=>utf8_encode($rowCl["nombre"])
	        );
    	}
    	else{
    		$rowdata[]=array(
	        	"id"=>$row["id"],
	        	"nombre"=>utf8_encode($row["nombre"]),
	        	"categoria"=>$row["idcategoria"],
	        	"club"=>$row["idclub"]
	        );
    	}
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>