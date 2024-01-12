<?php
include "db_connection.php";

        $Pos_ID=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['user']))));
     
        $Fk_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Sucursal']))));
        
        

        $sql = "UPDATE `PersonalPOS` 
        SET 
        `Fk_Sucursal`='$Fk_Sucursal' 
        WHERE Pos_ID=$Pos_ID";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>