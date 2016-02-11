<?php
    header("Content-Type: text/html;charset=utf-8");
	$json=file_get_contents('php://input');
	$obj=json_decode($json);

	include '../php/conn.php';
    
    $club=$_GET["club"];
    if($club!=""){
        $resClub=mysqli_query($con, "SELECT id FROM tclubs2 WHERE nombre='".$club."'")or die("ERROR EN LA CONSULTA.");
        $rowClub=mysqli_fetch_assoc($resClub);
        $idclub=$rowClub["id"];
        $resE=mysqli_query($con, "SELECT * FROM tequipos2 WHERE idclub='".$idclub."'")or die("ERROR EN LA CONSULTA.");
        $rowdata = array();
        $i=0;
        while($rowE = mysqli_fetch_array($resE)){
            $resP=mysqli_query($con, "SELECT * FROM tpartidos2 
                WHERE idequipo='".$rowE["id"]."'
                ORDER BY fecha")
                or die("ERROR EN LA CONSULTA.");
            while($row = mysqli_fetch_array($resP)){
            $dias=(strtotime($row['fecha'])-strtotime('now'))/60/60/24;
            $resC=mysqli_query($con, "SELECT nombre FROM tcategorias WHERE id='".$rowE["idcategoria"]."'")or die("ERROR EN LA CONSULTA.");
            $rowC=mysqli_fetch_assoc($resC);
            $fecha=date_format(new DateTime($row['fecha']), 'd-m-y H:i');
            if($idEquipo!=""){
                $resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido=".$row['id'])or die("ERROR EN LA CONSULTA.");
                $rowM=mysqli_fetch_array($resM);
                $rowdata[$i]=utf8_encode($rowC['nombre']);
                $rowdata[$i+1]=$fecha;
                $rowdata[$i+2]=utf8_encode($row['local']);
                if($rowM['ptsLocal']!=null)
                    $rowdata[$i+3]=$rowM['ptsLocal'];
                else
                    $rowdata[$i+3]="";
                if($rowM['ptsVis']!=null)
                    $rowdata[$i+4]=$rowM['ptsVis'];
                else
                    $rowdata[$i+4]="";
                $rowdata[$i+5]=utf8_encode($row['visitante']);
                $i=$i+6;
            }
            else if($dias<=4 && $dias>-4){
                $resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido=".$row['id'])or die("ERROR EN LA CONSULTA.");
                $rowM=mysqli_fetch_array($resM);
                $rowdata[$i]=utf8_encode($rowC['nombre']);
                $rowdata[$i+1]=$fecha;
                $rowdata[$i+2]=utf8_encode($row['local']);
                if($rowM['ptsLocal']!=null)
                    $rowdata[$i+3]=$rowM['ptsLocal'];
                else
                    $rowdata[$i+3]="";
                if($rowM['ptsVis']!=null)
                    $rowdata[$i+4]=$rowM['ptsVis'];
                else
                    $rowdata[$i+4]="";
                $rowdata[$i+5]=utf8_encode($row['visitante']);
                $i=$i+6;
            }
        }
        }
    }
    else{
        $idEquipo=$_GET["id"];
        if($idEquipo!=""){
            $resE=mysqli_query($con, "SELECT * FROM tequipos2 WHERE id='".$idEquipo."'")or die("ERROR EN LA CONSULTA.");
            $rowE = mysqli_fetch_assoc($resE);
            $resP=mysqli_query($con, "SELECT * FROM tpartidos2 
                WHERE idequipo='".$rowE["id"]."'
                ORDER BY fecha")
                or die("ERROR EN LA CONSULTA.");
        }
        else{
            $resP=mysqli_query($con, "SELECT * FROM tpartidos2 ORDER BY idequipo, fecha")or die("ERROR EN LA CONSULTA.");
        }

        $rowdata = array();
        $i=0;
        while($row = mysqli_fetch_array($resP)){
            $dias=(strtotime($row['fecha'])-strtotime('now'))/60/60/24;
            $resE=mysqli_query($con, "SELECT idcategoria FROM tequipos2 WHERE id='".$row["idequipo"]."'")or die("ERROR EN LA CONSULTA.");
            $rowE = mysqli_fetch_assoc($resE);
            $resC=mysqli_query($con, "SELECT nombre FROM tcategorias WHERE id='".$rowE["idcategoria"]."'")or die("ERROR EN LA CONSULTA.");
            $rowC=mysqli_fetch_assoc($resC);
            $fecha=date_format(new DateTime($row['fecha']), 'd-m-y H:i');
            if($idEquipo!=""){
                $resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido=".$row['id'])or die("ERROR EN LA CONSULTA.");
                $rowM=mysqli_fetch_array($resM);
                $rowdata[$i]=utf8_encode($rowC['nombre']);
                $rowdata[$i+1]=$fecha;
                $rowdata[$i+2]=utf8_encode($row['local']);
                if($rowM['ptsLocal']!=null)
                    $rowdata[$i+3]=$rowM['ptsLocal'];
                else
                    $rowdata[$i+3]="";
                if($rowM['ptsVis']!=null)
                    $rowdata[$i+4]=$rowM['ptsVis'];
                else
                    $rowdata[$i+4]="";
                $rowdata[$i+5]=utf8_encode($row['visitante']);
                $i=$i+6;
            }
            else if($dias<=3 && $dias>-4){
                $resM=mysqli_query($con, "SELECT * FROM tmarcadores2 WHERE idpartido=".$row['id'])or die("ERROR EN LA CONSULTA.");
                $rowM=mysqli_fetch_array($resM);
                $rowdata[$i]=utf8_encode($rowC['nombre']);
                $rowdata[$i+1]=$fecha;
                $rowdata[$i+2]=utf8_encode($row['local']);
                if($rowM['ptsLocal']!=null)
                    $rowdata[$i+3]=$rowM['ptsLocal'];
                else
                    $rowdata[$i+3]="";
                if($rowM['ptsVis']!=null)
                    $rowdata[$i+4]=$rowM['ptsVis'];
                else
                    $rowdata[$i+4]="";
                $rowdata[$i+5]=utf8_encode($row['visitante']);
                $i=$i+6;
            }
        }
    }

    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>