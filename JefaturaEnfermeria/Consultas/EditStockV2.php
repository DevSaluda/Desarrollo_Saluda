

<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_Prod']))));
       
        $Lote=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Loteee']))));
        $Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechacad']))));
        $Fecha_Ingreso=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechaingreso']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaProductosBy']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaProductos']))));
        $Existencias_R=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NuevaExistencia']))));
        $Fk_sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['StockActualiza']))));
        $sql = "UPDATE `Stock_POS` 
        SET 
        `Lote`='$Lote',
        `Fecha_Caducidad`='$Fecha_Caducidad',
        `Fecha_Ingreso`='$Fecha_Ingreso',
        `AgregadoPor`='$AgregadoPor',
        `Existencias_R`='$Existencias_R',
        `Sistema`='$Sistema'
WHERE ID_Prod_POS=$ID_Prod_POS AND  Fk_sucursal=$Fk_sucursal";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
