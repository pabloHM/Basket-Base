<?php
	include '../../php/conn.php';

	$hacer='true';
	$ids=array();
	$resIds=mysqli_query($con, "SELECT * FROM gcm");
	while($row = mysqli_fetch_array($resIds)){
        if($_GET['id']==$row["registration_id"]){
        	$hacer='false';
        }
    }
	
	if($hacer=='true'){
		$consulta="INSERT INTO gcm VALUES('".$_GET['id']."')";
		mysqli_query($con, $consulta) or die("ERROR PARA INSERTAR: ".$consulta);
	}
?>