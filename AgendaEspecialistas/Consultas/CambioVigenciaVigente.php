<?php
include "db_connection.php";
$ClaveEstatus="Vigente";
$Clavecolor="background-color:#b87455 !important";
        $ID_SucursalC=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
        $Estatus_Sucursal= $conn -> real_escape_string(htmlentities(strip_tags(Trim( $ClaveEstatus))));
       
        $Color_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($Clavecolor))));
       
  

        $sql = "UPDATE `Sucursales_CampañasV2` 
        SET `Estatus_Sucursal`='$Estatus_Sucursal',
        `Color_Sucursal`='$Color_Sucursal'
        WHERE ID_SucursalC=$ID_SucursalC";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>