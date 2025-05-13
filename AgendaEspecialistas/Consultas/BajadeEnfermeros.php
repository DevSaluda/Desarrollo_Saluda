<?php
include "db_connection.php";

        $Enfermero_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idbaja']))));
     
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
        $ColorEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ColorVigencia']))));
        

        $sql = "UPDATE `Personal_Enfermeria` 
        SET 
        `Estatus`='$Estatus',
        `ColorEstatus`='$ColorEstatus'
        WHERE Enfermero_ID=$Enfermero_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>