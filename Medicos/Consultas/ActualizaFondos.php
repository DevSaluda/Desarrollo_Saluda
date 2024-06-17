<?php
include "db_connection.php";

        $ID_Fon_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       $Fondo_Caja=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActCantidad']))));
      
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VigenciaEst']))));
        $CodigoEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));

        $sql = "UPDATE `Fondos_Cajas` 
        SET `Fondo_Caja`='$Fondo_Caja',
        `Estatus`='$Estatus',
        `CodigoEstatus`='$CodigoEstatus' 
        WHERE ID_Fon_Caja=$ID_Fon_Caja";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>