<?php
include "db_connection.php";
        $ID_Agenda_Especialista=$_POST['id'];
        $Estatus_cita=$_POST['estatuscitagenda'];
        $ColorEstatusCita=$_POST['coloragenda'];
      

        $sql = "UPDATE `AgendaCitas_EspecialistasV2` 
        SET `Estatus_cita`='$Estatus_cita',
        `ColorEstatusCita`='$ColorEstatusCita'
        WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);

?>