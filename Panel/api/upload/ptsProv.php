<?php
	include '../../php/conn.php';
	mysqli_query($con, "UPDATE tmarcadores2 SET ptsProvLoc=".$_GET["ptsLoc"].", ptsProvVis=".$_GET["ptsVis"]." WHERE idpartido=".$_GET["idpartido"])or die("UPDATE tmarcadores2 SET ptsProvLoc=".$_GET["ptsLoc"].", ptsProvVis=".$_GET["ptsVis"]." WHERE idpartido=".$_GET["idpartido"]);
?>