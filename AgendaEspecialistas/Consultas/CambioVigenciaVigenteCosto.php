<?php
include "db_connection.php";
$ClaveEstatus="Vigente";
$Clavecolor="background-color:#b87455 !important";
        $ID_Costo_Esp=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $Codigocolor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `Costos_EspecialistasV2` 
        SET `Estatus`='$Estatus',
        `Codigocolor`='$Codigocolor'
        WHERE ID_Costo_Esp=$ID_Costo_Esp";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>