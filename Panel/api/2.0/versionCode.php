<?php
    header("Content-Type: text/html;charset=utf-8");
	include '../../php/conn.php';
	$rowdata=array();
	$res=mysqli_query($con, "SELECT * FROM tVersionCode WHERE id=1")or die("ERROR EN LA CONSULTA.");
    $row = mysqli_fetch_assoc($res);
    $rowdata[]=array(
    	"versionCode"=>$row["versionCode"]
    );

	echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>