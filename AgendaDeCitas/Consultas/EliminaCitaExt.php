<?php
include "db_connection.php";
require '../vendor/autoload.php';

$ID_Agenda_Especialista = $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idcancelaExt']))));

// Obtener el GoogleEventId de la cita a eliminar
$sql_event = "SELECT GoogleEventId FROM AgendaCitas_EspecialistasExt WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";
$result = mysqli_query($conn, $sql_event);
$row = mysqli_fetch_assoc($result);
$GoogleEventId = $row['GoogleEventId'];

if ($GoogleEventId) {
    // Configurar el cliente de Google
    $client = new Google_Client();
    $client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Ruta al archivo JSON de credenciales
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $service = new Google_Service_Calendar($client);

    // ID del calendario
    $calendarId = '3dc95b55f97f949efe5e01222ec074eeccd45eb10888e94b4a2fc39c91a60dc4@group.calendar.google.com';

    // Intentar eliminar el evento de Google Calendar
    try {
        $service->events->delete($calendarId, $GoogleEventId);
    } catch (Exception $e) {
        echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
        exit();
    }
}

// Luego eliminar la cita de la base de datos
$sql = "DELETE FROM `AgendaCitas_EspecialistasExt` WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200));
} else {
    echo json_encode(array("statusCode"=>201));
}

mysqli_close($conn);
?>
