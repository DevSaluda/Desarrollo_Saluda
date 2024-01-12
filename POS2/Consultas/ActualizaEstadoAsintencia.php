<?php
include "db_connection.php";


        $ID_Agenda_Especialista=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_CitaActualizada']))));
     
        $Asistio=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Asistio']))));
        $ActualizoEstado=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ActualizadoPor']))));

        $sql = "UPDATE `AgendaCitas_EspecialistasExt` 
        SET  `Asistio`='$Asistio',
        `ActualizoEstado`='$ActualizoEstado'
WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>