<?php
	include "conn.php";
	session_start();

	$tabla=$_GET["tabla"];

	switch($tabla){
		case "users":
			$consulta="SELECT * FROM tusers2 WHERE nombre='".$_POST["nombre"]."' AND pass='".substr(md5($_POST["pass"]), 0, 15)."'";
			$res = mysqli_query($con, $consulta)or die($consulta);
			$row=mysqli_fetch_assoc($res);

			if(mysqli_num_rows($res)==1){
				$_SESSION['id'] = $row['id'];
				$_SESSION['uName'] = $row['nombre'];
				$_SESSION['permiso'] = $row['permiso'];
				$_SESSION['tiempo']=date("Y-m-d H:i:s");
				$_SESSION['recordar']=$_POST["save"];
				echo true;
			}
			else{
				echo false;
			}
		break;
	}
?>