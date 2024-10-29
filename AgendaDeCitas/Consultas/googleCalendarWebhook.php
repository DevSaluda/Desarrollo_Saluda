<?php
include "db_connection.php";

// Capturar el cuerpo de la notificación
$request_body = file_get_contents('php://input');
file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Notificación recibida: " . $request_body . PHP_EOL, FILE_APPEND);

// Decodificar la notificación
$data = json_decode($request_body, true);

// Obtener el calendario específico desde los datos de la notificación
$calendarId = $data['calendarId'] ?? null; // Ajusta esto si el campo difiere
if (!$calendarId) {
    file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error: No se encontró calendarId en la notificación." . PHP_EOL, FILE_APPEND);
    exit;
}

// Sincronizar la base de datos con el calendario correspondiente
syncWithGoogleCalendar($conn, $calendarId);

mysqli_close($conn);

// Función para sincronizar los eventos de un calendario específico
function syncWithGoogleCalendar($conn, $calendarId) {
    require '../vendor/autoload.php';

    $client = new Google_Client();
    $client->setAuthConfig('../../app-saluda-966447541c3c.json');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $service = new Google_Service_Calendar($client);

    // Obtener todos los eventos del calendario de Google especificado
    $events = $service->events->listEvents($calendarId);

    // Obtener los registros de la base de datos que tienen un GoogleEventId y coinciden con este calendario
    $sql = "SELECT GoogleEventId FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId IS NOT NULL AND IDGoogleCalendar = '$calendarId'";
    $result = mysqli_query($conn, $sql);

    $dbEventIds = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dbEventIds[] = $row['GoogleEventId'];
    }

    // Crear una lista de los GoogleEventId actuales en Google Calendar
    $googleEventIds = [];
    foreach ($events->getItems() as $event) {
        $googleEventIds[] = $event->getId();
    }

    // Eliminar eventos de la base de datos que ya no existen en Google Calendar
    foreach ($dbEventIds as $dbEventId) {
        if (!in_array($dbEventId, $googleEventIds)) {
            $deleteSql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '$dbEventId'";
            mysqli_query($conn, $deleteSql);
            file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Evento eliminado de la base de datos: " . $dbEventId . " del calendario: $calendarId" . PHP_EOL, FILE_APPEND);
        }
    }

    echo "Sincronización completada para el calendario $calendarId";
}
?>
