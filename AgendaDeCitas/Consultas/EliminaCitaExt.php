<?php
include "db_connection.php";
require '../vendor/autoload.php';

$ID_Agenda_Especialista = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['idcancelaExt']))));

// Obtener el GoogleEventId y el IDGoogleCalendar de la cita a eliminar
$sql_event = "SELECT GoogleEventId, IDGoogleCalendar FROM AgendaCitas_EspecialistasExt WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";
$result = mysqli_query($conn, $sql_event);
$row = mysqli_fetch_assoc($result);
$GoogleEventId = $row['GoogleEventId'];
$calendarId = $row['IDGoogleCalendar'];

if ($GoogleEventId && $calendarId) {
    // Configurar el cliente de Google
    $client = new Google_Client();
    $client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Ruta al archivo JSON de credenciales
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $service = new Google_Service_Calendar($client);

    // Intentar eliminar el evento de Google Calendar
    try {
        $service->events->delete($calendarId, $GoogleEventId);
    } catch (Exception $e) {
        // Si el error es porque el evento no existe, continuar con el borrado
        if (
            strpos($e->getMessage(), '404') !== false ||
            strpos($e->getMessage(), '410') !== false ||
            strpos($e->getMessage(), 'notFound') !== false ||
            strpos($e->getMessage(), 'No se ha encontrado') !== false ||
            strpos($e->getMessage(), 'Resource deleted') !== false ||
            strpos($e->getMessage(), 'Resource has been deleted') !== false ||
            strpos($e->getMessage(), 'deleted') !== false
        ) {
            // Continuar con el borrado de la agenda
            $sql = "DELETE FROM `AgendaCitas_EspecialistasExt` WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 201));
            }
            mysqli_close($conn);
            exit();
        } else {
            echo json_encode(array("statusCode" => 400, "error" => $e->getMessage()));
            exit();
        }
    }
}

// Luego eliminar la cita de la base de datos solo si no hubo excepción
$sql = "DELETE FROM `AgendaCitas_EspecialistasExt` WHERE ID_Agenda_Especialista = '$ID_Agenda_Especialista'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
?>
