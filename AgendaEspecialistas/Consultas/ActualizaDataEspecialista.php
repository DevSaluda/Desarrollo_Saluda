<?php
include "db_connection.php";
$Nombre_Apellidos=$conn -> real_escape_string(htmlentities(strip_tags(Trim((ucwords(strtolower($_POST['actnombres'])))))));
$Tel=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['acttel']))));
$Correo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['actcorreo']))));
$ID_Especialista=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['id']))));
       


        $sql = "UPDATE `EspecialistasV2` 
        SET `Nombre_Apellidos`='$Nombre_Apellidos',
        `Tel`='$Tel',
        `Correo`='$Correo'
        WHERE ID_Especialista=$ID_Especialista";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>