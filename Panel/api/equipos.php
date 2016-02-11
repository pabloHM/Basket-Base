<?php
    header("Content-Type: text/html;charset=utf-8");
	$json=file_get_contents('php://input');
	$obj=json_decode($json);

	include '../php/conn.php';
    $id=$_GET["idclub"];
    if($id=="")
	   $res=mysqli_query($con, "SELECT * FROM tequipos2 ORDER BY idcategoria")or die("ERROR EN LA CONSULTA.");
    else
        $res=mysqli_query($con, "SELECT tequipos2.id, tequipos2.idcategoria, tequipos2.nombre FROM tequipos2, tcategorias WHERE idclub=".$id." AND tequipos2.idcategoria=tcategorias.id ORDER BY tcategorias.orden")or die("ERROR EN LA CONSULTA.");
	$rowdata = array();
    $i=0;
    while($row = mysqli_fetch_array($res)){
        $resC=mysqli_query($con, "SELECT nombre FROM tcategorias WHERE id='".$row["idcategoria"]."'")or die("ERROR EN LA CONSULTA.");
        $rowC=mysqli_fetch_assoc($resC);
        $rowdata[$i]=utf8_encode($row['id']);
        $rowdata[$i+1]=utf8_encode($rowC['nombre']);
        $rowdata[$i+2]=utf8_encode($row['nombre']);
        $i=$i+3;
    }

    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>