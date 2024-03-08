<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_ProdS']))));
       
        $Lote=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Loteees']))));
        $Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechacads']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosByS']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductosS']))));
        $sql = "UPDATE `Stock_POS` 
        SET 
        `Lote`='$Lote',
        `Fecha_Caducidad`='$Fecha_Caducidad',
        `AgregadoPor`='$AgregadoPor',
        `Sistema`='$Sistema'
WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>400));
	} 
	else {
		echo json_encode(array("statusCode"=>401));
	}
	mysqli_close($conn);
