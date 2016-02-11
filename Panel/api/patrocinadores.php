<?php
    header("Content-Type: text/html;charset=utf-8");
	$json=file_get_contents('php://input');
	$obj=json_decode($json);

	include '../php/conn.php';
	$res=mysqli_query($con, "SELECT * FROM tpatrocinadores2")or die("ERROR EN LA CONSULTA.");
	$rowdata = "[";
    while($row = mysqli_fetch_array($res)){
        $rowdata=$rowdata.utf8_encode($row['nombre']).";".$row['url'].";".$row['imagen'].";";
        echo $fila;
    }
    $rowdata = $rowdata."]";
    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>