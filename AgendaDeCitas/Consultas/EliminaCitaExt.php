<?php
include "db_connection.php";
require '../vendor/autoload.php';

$ID_Agenda_Especialista = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['idcancelaExt']))));

// Obtener los IDs de Fecha y Horario asociados a la agenda
$sql_get = "SELECT Fecha, Hora, GoogleEventId, IDGoogleCalendar FROM AgendaCitas_EspecialistasExt WHERE ID_Agenda_Especialista='$ID_Agenda_Especialista'";
$result = mysqli_query($conn, $sql_get);
if ($row = mysqli_fetch_assoc($result)) {
    $id_fecha = $row['Fecha'];
    $id_hora = $row['Hora'];
    $GoogleEventId = $row['GoogleEventId'];
    $calendarId = $row['IDGoogleCalendar'];

    // Intentar eliminar el evento de Google Calendar
    if ($GoogleEventId && $calendarId) {
        $client = new Google_Client();
        $client->setAuthConfig('../../app-saluda-966447541c3c.json');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $service = new Google_Service_Calendar($client);
        try {
            $service->events->delete($calendarId, $GoogleEventId);
        } catch (Exception $e) {
            // Si el error es porque el evento no existe, continuar
            if (
                strpos($e->getMessage(), '404') === false &&
                strpos($e->getMessage(), '410') === false &&
                strpos($e->getMessage(), 'notFound') === false &&
                strpos($e->getMessage(), 'No se ha encontrado') === false &&
                strpos($e->getMessage(), 'Resource deleted') === false &&
                strpos($e->getMessage(), 'Resource has been deleted') === false &&
                strpos($e->getMessage(), 'deleted') === false
            ) {
                echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
                exit();
            }
        }
    }

    // 1. Actualizar estado de la agenda a 'Cancelado'
    $sql_update_agenda = "UPDATE AgendaCitas_EspecialistasExt SET Estatus_cita='Cancelado' WHERE ID_Agenda_Especialista='$ID_Agenda_Especialista'";
    $agenda_ok = mysqli_query($conn, $sql_update_agenda);

    // 2. Actualizar estado de la fecha a 'Disponible'
    $sql_update_fecha = "UPDATE Fechas_EspecialistasExt SET Estado='Disponible' WHERE ID_Fecha_Esp='$id_fecha'";
    $fecha_ok = mysqli_query($conn, $sql_update_fecha);

    // 3. Actualizar estado de la hora a 'Disponible'
    $sql_update_hora = "UPDATE Horarios_Citas_Ext SET Estado='Disponible' WHERE ID_Horario='$id_hora'";
    $hora_ok = mysqli_query($conn, $sql_update_hora);

    if ($agenda_ok && $fecha_ok && $hora_ok) {
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
} else {
    echo json_encode(array("statusCode"=>404, "message"=>"No se encontró la agenda"));
}
mysqli_close($conn);
?>
