<?php
include "db_connection.php";

        $PersonalAgenda_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idbaja']))));
     
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
        $ColorEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ColorVigencia']))));
        

        $sql = "UPDATE `Personal_Agenda` 
        SET 
        `Estatus`='$Estatus',
        `ColorEstatus`='$ColorEstatus'
        WHERE PersonalAgenda_ID=$PersonalAgenda_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>