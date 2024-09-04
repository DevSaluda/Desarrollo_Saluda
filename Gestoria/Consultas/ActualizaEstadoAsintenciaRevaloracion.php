<?php
include "db_connection.php";


        $Id_genda=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_CitaActualizada']))));
     
        $Asistio=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Asistio']))));
        $ActualizoEstado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActualizadoPor']))));

        $sql = "UPDATE `Agenda_revaloraciones` 
        SET  `Asistio`='$Asistio',
        `ActualizoEstado`='$ActualizoEstado'
WHERE Id_genda=$Id_genda";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>