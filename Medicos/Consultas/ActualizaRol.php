<?php
include "db_connection.php";

        $ID_rol=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       $Nombre_rol=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombres']))));

        $Agrego=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaAct']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaAct']))));
     

        $sql = "UPDATE `Roles_Puestos` 
        SET `Nombre_rol`='$Nombre_rol',

        `Agrego`='$Agrego',
        `Sistema`='$Sistema'
        WHERE ID_rol=$ID_rol";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>