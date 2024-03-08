<?php
include "db_connection.php";

        $ID_Prod_POS=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Act_Stock_ID']))));
        $Nombre_Prod=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NombreStockActualiza']))));
        $Precio_Venta=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['preciostockventa']))));
        $Precio_C=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['preciostockcompra']))));
        $Clave_Levic=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['actualizaClavelevic']))));
        $Cod_Enfermeria=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActualizaClaveEnfermeria']))));
        $sql = "UPDATE `Stock_POS` 
        SET 
        `Precio_Venta`='$Precio_Venta',
        `Nombre_Prod`='$Nombre_Prod',
        `Cod_Enfermeria`='$Cod_Enfermeria',
        `Clave_Levic`='$Clave_Levic',
        `Precio_C`='$Precio_C'
WHERE ID_Prod_POS=$ID_Prod_POS";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
