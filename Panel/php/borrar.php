<?php
	include 'conn.php';
	session_start();
	$modal = $_POST['modal'];
	$id = $_POST['id'];
	$qry = "DELETE FROM ".$modal."2 WHERE id=".$id;
	
	$res = mysqli_query($con, $qry)or die($qry);

	echo true;
?>