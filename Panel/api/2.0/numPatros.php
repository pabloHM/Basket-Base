<?php
	include '../../php/conn.php';
	$resN=mysqli_query($con, "SELECT COUNT(*) FROM tpatrocinadores2")or die("ERROR CUENTA.");
    $rowN = mysqli_fetch_assoc($resN);
    $rowdata[]=array(
    	"total"=>$rowN['COUNT(*)']);
    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>