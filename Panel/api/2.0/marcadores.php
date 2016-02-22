<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$id=$_GET["id"];
	$idcategoria=$_GET["idcategoria"];
	$idequipo=$_GET["idequipo"];
	$idclub=$_GET["idclub"];
	$format=$_GET["format"];
	$fecha=$_GET["fecha"];
	$where="";
	$condicion=false;
	if($id!=""){
		$where=$where."id='".$id."'";
		$condicion=true;
	}
	if($idequipo!=""){
		if($condicion==true){
			$where=$where." AND ";
		}
		$where=$where."idequipo='".$idequipo."'";
		$condicion=true;
	}

	if($condicion==true){
		$resP=mysqli_query($con, "SELECT * FROM tpartidos2 WHERE ".$where)or die("ERROR EN LA CONSULTA.");
	}
	else if($idclub!=""){
		if($idclub=="0"){
			$petClub=mysqli_query($con, "SELECT * FROM tclubs2 WHERE bb=1 ORDER BY RAND() LIMIT 1")or die("ERROR EN LA CONSULTA DE CLUB ALEATORIO.");
			$resClub=mysqli_fetch_assoc($petClub);
			$idclub=$resClub["id"];
		}
		$resP=mysqli_query($con, "SELECT * FROM tpartidos2 WHERE idequipo IN(SELECT id FROM tequipos2 WHERE idclub=".$idclub.")")or die("ERROR EN LA CONSULTA");
	}
    while($rowP = mysqli_fetch_array($resP)){
    	$resE=mysqli_query($con, "SELECT idcategoria FROM tequipos2 WHERE id=".$rowP["idequipo"])or die("ERROR EN LA CONSULTA.");
	    $rowE = mysqli_fetch_assoc($resE);
	    $resC=mysqli_query($con, "SELECT nombre FROM tcategorias WHERE id=".$rowE["idcategoria"])or die("ERROR EN LA CONSULTA.");
	    $rowC = mysqli_fetch_assoc($resC);
		$resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido=".$rowP["id"])or die("ERROR EN LA CONSULTA.");
    	$rowM = mysqli_fetch_assoc($resM);

	    $ptsLocal="";
	    $ptsVis="";
	    if($rowM["ptsLocal"]!=null){
	    	$ptsLocal=$rowM["ptsLocal"];
	    }
	    if($rowM["ptsVis"]!=null){
	    	$ptsVis=$rowM["ptsVis"];
	    }
	    $dias=(strtotime($rowP['fecha'])-strtotime('now'))/60/60/24;
	    if($idequipo!=""){
	        $rowdata[]=array(
	        	"idpartido"=>$rowP["id"],
	        	"categoria"=>utf8_encode($rowC["nombre"]),
	        	"local"=>utf8_encode($rowP["local"]),
	        	"resultado"=>$ptsLocal." - ".$ptsVis,
	        	"visitante"=>utf8_encode($rowP["visitante"]),
	        	"fecha"=>date_format(new DateTime($rowP['fecha']), 'd-m-y H:i'),
	        	"ptsProvLoc"=>$rowM["ptsProvLoc"],
	        	"ptsProvVis"=>$rowM["ptsProvVis"]
	        );
	    }
	    else if($dias<=4 && $dias>-4){
	    	$rowdata[]=array(
	        	"idpartido"=>$rowP["id"],
	        	"categoria"=>utf8_encode($rowC["nombre"]),
	        	"local"=>utf8_encode($rowP["local"]),
	        	"resultado"=>$ptsLocal." - ".$ptsVis,
	        	"visitante"=>utf8_encode($rowP["visitante"]),
	        	"fecha"=>date_format(new DateTime($rowP['fecha']), 'd-m-y H:i'),
	        	"ptsProvLoc"=>$rowM["ptsProvLoc"],
	        	"ptsProvVis"=>$rowM["ptsProvVis"]
	        );
	    }
    }

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>