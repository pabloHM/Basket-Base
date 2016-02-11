<?php
    header("Content-Type: text/html;charset=utf-8");
	$json=file_get_contents('php://input');
	$obj=json_decode($json);

	include '../php/conn.php';
    $bb=$_GET["bb"];
    if($bb=="1")
	   $res=mysqli_query($con, "SELECT * FROM tclubs2 WHERE bb=1")or die("ERROR EN LA CONSULTA.");
    else
        $res=mysqli_query($con, "SELECT * FROM tclubs2")or die("ERROR EN LA CONSULTA.");
	$rowdata = array();
    $i=0;
    while($row = mysqli_fetch_array($res)){
        $rowdata[$i]=utf8_encode($row['nombre']);
        $rowdata[$i+1]=utf8_encode($row['id']);
        $i=$i+2;
    }

    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>