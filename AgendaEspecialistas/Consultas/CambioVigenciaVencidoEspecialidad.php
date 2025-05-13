<?php
include "db_connection.php";
$ClaveEstatus="Vencido";
$Clavecolor="background-color:#80391e !important";
        $ID_Especialidad=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus_Especialidad= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $Codigocolor=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `EspecialidadesV2` 
        SET `Estatus_Especialidad`='$Estatus_Especialidad',
        `Codigocolor`='$Codigocolor'
        WHERE ID_Especialidad=$ID_Especialidad";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>