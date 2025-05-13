<?php
include "db_connection.php";
$ClaveEstatus="Vigente";
$Clavecolor="background-color:#b87455 !important";
        $ID_Especialista=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus_Especialista= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $CodigoColorEs=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `EspecialistasV2` 
        SET `Estatus_Especialista`='$Estatus_Especialista',
        `CodigoColorEs`='$CodigoColorEs'
        WHERE ID_Especialista=$ID_Especialista";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>