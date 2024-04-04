<?php
include "db_connection.php";

        $Medico_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idbaja']))));
     
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
        $ColorEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ColorVigencia']))));
        

        $sql = "UPDATE `Personal_Medico` 
        SET 
        `Estatus`='$Estatus',
        `ColorEstatus`='$ColorEstatus'
        WHERE Medico_ID=$Medico_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>