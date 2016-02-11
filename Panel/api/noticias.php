<?php
    header("Content-Type: text/html;charset=utf-8");
    $json=file_get_contents('php://input');
    $obj=json_decode($json);

    include '../php/conn.php';
    $res2=mysqli_query($con, "SELECT COUNT(*) FROM tnoticias2")or die("ERROR CUENTA NOTICIAS");
    $row2 = mysqli_fetch_array($res2);
    $res=mysqli_query($con, "SELECT * FROM tnoticias2 ORDER BY id DESC LIMIT ".$_GET["start"].",10")or die("ERROR NOTICIAS");
    $rowdata = "[";
    $i=0;
    while($row = mysqli_fetch_array($res)){
        $resC=mysqli_query($con, "SELECT * FROM tclubs2 WHERE id='".$row['idclub']."'")or die("ERROR CLUBS");
        $rowC=mysqli_fetch_assoc($resC);
        $cuerpo=str_replace("\r", "", $row['cuerpo']);
        $rowdata = $rowdata.utf8_encode($row['titulo']).";&;";
        $rowdata = $rowdata.utf8_encode($rowC['nombre']." - ".$row['subtitulo']).";&;";
        $rowdata = $rowdata.utf8_encode($cuerpo).";&;";
        $rowdata = $rowdata.$row['imagen'].";&;";
    }
    $rowdata = $rowdata.$row2[0]."]";
    echo json_encode($rowdata, JSON_UNESCAPED_UNICODE);
?>