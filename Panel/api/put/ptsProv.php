<?php
	include '../../php/conn.php';
	mysqli_query($con, "INSERT INTO tmarcadores2(idpartido, ptsProvLoc, ptsProvVis) VALUES(".$_GET["idpartido"].", ".$_GET["ptsLoc"].", ".$_GET["ptsVis"].")")or die("INSERT INTO tmarcadores2(idpartido, ptsProvLoc, ptsProvVis) VALUES(".$_GET["idpartido"].", ".$_GET["ptsLoc"].", ".$_GET["ptsVis"].")");
?>