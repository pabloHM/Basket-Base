<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$idpatro=$_GET["idpatro"];
	$mensaje=$_GET["mensaje"];
	$url=$_GET["url"];
	$imagen=$_GET["imagen"];
	$fechaFin=$_GET["fechaFin"];
	$format=$_GET["format"];
	$where="";
	$condicion=false;
	if($id!=""){
		$where=$where."id='".$id."'";
		$condicion=true;
	}
	if($idpatro!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idpatro='".$idpatro."'";
		$condicion=true;
	}
	if($mensaje!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."mensaje='".$mensaje."'";
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
	if($fechaFin!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."fechaFin='".$fechaFin."'";
		$condicion=true;
	}

	if($condicion==true){
		$res=mysqli_query($con, "SELECT * FROM tofertas2 WHERE ".$where." ORDER BY id DESC")or die("ERROR EN LA CONSULTA.");
	}
	else{
		$res=mysqli_query($con, "SELECT * FROM tofertas2 ORDER BY id DESC")or die("ERROR EN LA CONSULTA.");
	}
    while($row = mysqli_fetch_array($res)){
    	if((strtotime($row['fechaFin'])-strtotime('now'))>=0){
	    	$mensaje=str_replace("\r","", utf8_encode($row["mensaje"]));
	    	if($format=="text"){
	    		$resP=mysqli_query($con, "SELECT nombre FROM tpatrocinadores2 WHERE id=".$row["idpatro"])or die("ERROR EN LA CONSULTA.");
		        $rowP = mysqli_fetch_assoc($resP);
		        $rowdata[]=array(
		        	"id"=>$row["id"],
		        	"idpatro"=>utf8_encode($rowP["nombre"]),
		        	"mensaje"=>$mensaje,
		        	"url"=>$row["url"],
		        	"imagen"=>$row["imagen"],
		        	"fechaFin"=>$row["fechaFin"]
		        );
	    	}
	    	else{
		        $rowdata[]=array(
		        	"id"=>$row["id"],
		        	"idpatro"=>$row["idpatro"],
		        	"mensaje"=>$mensaje,
		        	"url"=>$row["url"],
		        	"imagen"=>$row["imagen"],
		        	"fechaFin"=>$row["fechaFin"]
		        );
		    }
		}
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>