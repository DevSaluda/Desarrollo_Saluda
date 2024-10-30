<?php 
include "db_connection.php";

// Capturar el cuerpo de la notificación
$request_body = file_get_contents('php://input');
file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Notificación recibida: " . $request_body . PHP_EOL, FILE_APPEND);

try {
    // Sincronizar la base de datos con todos los calendarios registrados
    syncAllCalendars($conn);
} catch (Exception $e) {
    file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error en la sincronización: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
}

mysqli_close($conn);

// Función para sincronizar todos los calendarios con la base de datos
function syncAllCalendars($conn) {
    require '../vendor/autoload.php';

    $client = new Google_Client();
    $client->setAuthConfig('../../app-saluda-966447541c3c.json');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $service = new Google_Service_Calendar($client);

    // Obtener todos los IDGoogleCalendar de los médicos en la base de datos
    $sql_calendars = "SELECT DISTINCT IDGoogleCalendar FROM Personal_Medico_Express WHERE IDGoogleCalendar IS NOT NULL";
    $result_calendars = mysqli_query($conn, $sql_calendars);

    if (!$result_calendars) {
        throw new Exception("Error en la consulta de calendarios: " . mysqli_error($conn));
    }

    $calendarEventIds = [];
    
    // Iterar sobre cada calendario registrado y obtener sus eventos actuales
    while ($row_calendar = mysqli_fetch_assoc($result_calendars)) {
        $calendarId = $row_calendar['IDGoogleCalendar'];
        
        try {
            // Obtener eventos del calendario actual
            $events = $service->events->listEvents($calendarId);
        } catch (Exception $e) {
            file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error al obtener eventos de Google Calendar para $calendarId: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            continue;
        }

        foreach ($events->getItems() as $event) {
            $calendarEventIds[] = $event->getId(); // Almacenar todos los GoogleEventId de este calendario
        }
    }

    // Obtener todos los GoogleEventId de la base de datos para verificar cuáles ya no existen
    $sql_events = "SELECT GoogleEventId FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId IS NOT NULL";
    $result_events = mysqli_query($conn, $sql_events);

    if (!$result_events) {
        throw new Exception("Error en la consulta de eventos de la base de datos: " . mysqli_error($conn));
    }

    while ($row_event = mysqli_fetch_assoc($result_events)) {
        $dbEventId = $row_event['GoogleEventId'];

        // Si el evento de la base de datos no existe en ninguno de los calendarios, eliminarlo
        if (!in_array($dbEventId, $calendarEventIds)) {
            $deleteSql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '$dbEventId'";
            if (!mysqli_query($conn, $deleteSql)) {
                file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error al eliminar evento $dbEventId de la base de datos: " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
            } else {
                file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Evento eliminado de la base de datos: " . $dbEventId . PHP_EOL, FILE_APPEND);
            }
        }
    }

    file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Sincronización completada para todos los calendarios registrados." . PHP_EOL, FILE_APPEND);
}
?>
