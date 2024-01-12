<?php
include "db_connection.php";
$ClaveEstatus="Vencido";
$Clavecolor="background-color:#80391e !important";
        $Fk_Fecha=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['fechaf']))));
        $Estatus_Horario= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $CodigoColorHo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `Horarios_Citas_especialistasV2` 
        SET `Estatus_Horario`='$Estatus_Horario',
        `CodigoColorHo`='$CodigoColorHo'
        WHERE Fk_Fecha=$Fk_Fecha";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>