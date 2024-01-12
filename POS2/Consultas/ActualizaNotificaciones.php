<?php
include "db_connection.php";

        $ID_Notificacion=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idactualizable']))));
      $Estado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['nuevoestado']))));

        $sql = "UPDATE `Area_De_Notificaciones` 
        SET `Estado`='$Estado'
        
        
        WHERE ID_Notificacion=$ID_Notificacion";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>