<?php
include "db_connection.php";


// Obtener el GoogleEventId y el IDGoogleCalendar de la cita a eliminar2
$sql_event = "SELECT GoogleEventId, IDGoogleCalendar FROM AgendaCitas_EspecialistasExt WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";
$result = mysqli_query($conn, $sql_event);
$row = mysqli_fetch_assoc($result);
$GoogleEventId = $row['GoogleEventId'];
$calendarId = $row['IDGoogleCalendar'];

        $sql = "DELETE FROM `AgendaCitas_EspecialistasExt`  WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
       
       if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>