<?php
include "db_connection.php";

        $Folio_Prod_Stock=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Folioporact']))));
        $Existencias_R=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ExistenciasReales']))));
        $Lote=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Lote']))));
        $Fecha_Caducidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaCad']))));
        $AgregadoPor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Usuario']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sistema']))));
        $sql = "UPDATE `Stock_POS` 
        SET 
        `Lote`='$Lote',
        `Fecha_Caducidad`='$Fecha_Caducidad',
        `Existencias_R`='$Existencias_R',
        `AgregadoPor`='$AgregadoPor',
        `Sistema`='$Sistema'
WHERE Folio_Prod_Stock=$Folio_Prod_Stock";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
