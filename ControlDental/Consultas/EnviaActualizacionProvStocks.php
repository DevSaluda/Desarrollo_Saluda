<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Act_Stock_ID']))));
       
        $Proveedor1=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Proveedor1Stock']))));
        $Proveedor2=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Proveedor2Stock']))));
        $Tipo_Servicio=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ServicioNuevo']))));
       
        $sql = "UPDATE `Stock_POS` 
        SET 
        `Proveedor1`='$Proveedor1',
        `Proveedor2`='$Proveedor2',
        `Tipo_Servicio`='$Tipo_Servicio'
WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
