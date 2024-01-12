<?php
include "db_connection.php";

        $Folio_Prod_Stock=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id_Stock']))));
     
       $Existencias_R=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActExistenciasR']))));
        
        $sql = "UPDATE `Stock_POS` 
        SET `Existencias_R`='$Existencias_R'
WHERE Folio_Prod_Stock=$Folio_Prod_Stock";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
