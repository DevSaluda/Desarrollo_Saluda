<?php
include "db_connection.php";

// Capturar el cuerpo de la notificación
$request_body = file_get_contents('php://input');
file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Notificación recibida: " . $request_body . PHP_EOL, FILE_APPEND);

// Decodificar la notificación
$data = json_decode($request_body, true);

// Ejecutar la sincronización al recibir cualquier notificación
syncWithGoogleCalendar($conn);

mysqli_close($conn);

// Función para sincronizar los eventos
function syncWithGoogleCalendar($conn) {
    require '../vendor/autoload.php';

    $client = new Google_Client();
    $client->setAuthConfig('../../app-saluda-966447541c3c.json');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $service = new Google_Service_Calendar($client);

    $calendarId = '3dc95b55f97f949efe5e01222ec074eeccd45eb10888e94b4a2fc39c91a60dc4@group.calendar.google.com';

    // Obtener todos los eventos del calendario de Google
    $events = $service->events->listEvents($calendarId);

    // Obtener solo los registros de la base de datos que tienen un GoogleEventId
    $sql = "SELECT GoogleEventId FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId IS NOT NULL";
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

    // Buscar y eliminar eventos que no estén en Google Calendar
    foreach ($dbEventIds as $dbEventId) {
        if (!in_array($dbEventId, $googleEventIds)) {
            // Eliminar el evento de la base de datos
            $deleteSql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '$dbEventId'";
            mysqli_query($conn, $deleteSql);
            file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Evento eliminado de la base de datos: " . $dbEventId . PHP_EOL, FILE_APPEND);
        }
    }

    echo "Sincronización completada";
}
?>
