<?php
include "db_connection.php";

        $ID_rol=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ids']))));
       $Nombre_rol=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActNombress']))));
       $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActEstado'])))); 
        $Agrego=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AgregaActs']))));
        $Sistema=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaActs']))));
     

        $sql = "UPDATE `Roles_Puestos` 
        SET `Nombre_rol`='$Nombre_rol',
        `Estado`='$Estado',
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