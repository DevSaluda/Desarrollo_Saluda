<?php
include "db_connection.php";

        $ID_SucursalC=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       $Nombre_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombres']))));
       $Telefono =$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AcTtelefono']))));
        $Agrego=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaAct']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaAct']))));
     

        $sql = "UPDATE `SucursalesCorre` 
        SET `Nombre_Sucursal`='$Nombre_Sucursal',
        `Telefono`='$Telefono',
        `Agrego`='$Agrego',
        `Sistema`='$Sistema'
        WHERE ID_SucursalC=$ID_SucursalC";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>