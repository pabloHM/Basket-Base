<?php
	include '../php/conn.php';
	session_start();

	move_uploaded_file($_FILES['imagen']['tmp_name'], "../img/".$_GET["carpeta"]."/".$_FILES['imagen']['name']);

	echo $_FILES['imagen']['name'];
?>