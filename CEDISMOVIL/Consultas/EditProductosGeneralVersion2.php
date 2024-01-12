<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_Prod']))));
       
        $Lote_Med=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Loteee']))));
        $Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechacad']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));
        $sql = "UPDATE `Productos_POS` 
        SET 
        `Lote_Med`='$Lote_Med',
        `Fecha_Caducidad`='$Fecha_Caducidad',
        `AgregadoPor`='$AgregadoPor',
        `Sistema`='$Sistema'
WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
