<?php
include "db_connection.php";
$ClaveEstatus="Vencido";
$Clavecolor="background-color:#80391e !important";
        $ID_Fecha_Esp=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus_fecha= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $CodigoColorFe=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `Fechas_EspecialistasV2` 
        SET `Estatus_fecha`='$Estatus_fecha',
        `CodigoColorFe`='$CodigoColorFe'
        WHERE ID_Fecha_Esp=$ID_Fecha_Esp";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>