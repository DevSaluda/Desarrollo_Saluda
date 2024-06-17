<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ACT_ID_Prod']))));
        $Proveedor1=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Provee1']))));
        $Proveedor2=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Provee2']))));
        $Tipo_Servicio=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TipoServicio']))));
        $sql = "UPDATE `Productos_POS` 
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
