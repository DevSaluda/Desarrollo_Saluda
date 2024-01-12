<?php
include "db_connection.php";

        $Medico_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idbaja']))));
     
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
       

        $sql = "UPDATE `Personal_Medico_Express` 
        SET 
        `Estatus`='$Estatus'
        WHERE Medico_ID=$Medico_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>