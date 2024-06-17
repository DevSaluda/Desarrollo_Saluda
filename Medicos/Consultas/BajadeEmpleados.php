<?php
include "db_connection.php";

        $Pos_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idbaja']))));
     
        $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Vigencia']))));
        $ColorEstatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ColorVigencia']))));
        

        $sql = "UPDATE `PersonalPOS` 
        SET 
        `Estatus`='$Estatus',
        `ColorEstatus`='$ColorEstatus'
        WHERE Pos_ID=$Pos_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>