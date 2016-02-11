<?php
    header("Content-Type: text/html;charset=utf-8");
	$json=file_get_contents('php://input');
	$obj=json_decode($json);

	include '../php/conn.php';
	$res=mysqli_query($con, "SELECT * FROM tofertas2 ORDER BY id DESC")or die("ERROR EN LA CONSULTA.");
	$rowdata = "[";
    $i=0;
    while($row = mysqli_fetch_array($res)){
        $resP=mysqli_query($con, "SELECT nombre FROM tpatrocinadores2 WHERE id='".$row["idpatro"]."'")or die("ERROR EN LA CONSULTA.");
        $rowP=mysqli_fetch_assoc($resP);
        $mensaje=str_replace("\r", "", $row['mensaje']);
        if((strtotime($row['fechaFin'])-strtotime('now'))>=0){
            $rowdata = $rowdata.utf8_encode($rowP['nombre']).";&;";
            $rowdata = $rowdata.utf8_encode($mensaje).";&;";
            $rowdata = $rowdata.$row['url'].";&;";
            $rowdata = $rowdata.$row['imagen'].";&;";
        }
    }
    $rowdata = $rowdata."]";

    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>