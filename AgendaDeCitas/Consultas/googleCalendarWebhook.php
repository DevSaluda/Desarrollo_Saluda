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
    $googleEvents = [];

    // Iterar sobre cada calendario registrado y obtener sus eventos actuales
    while ($row_calendar = mysqli_fetch_assoc($result_calendars)) {
        $calendarId = $row_calendar['IDGoogleCalendar'];
        
        try {
            $events = $service->events->listEvents($calendarId);
        } catch (Exception $e) {
            file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error al obtener eventos de Google Calendar para $calendarId: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            continue;
        }

        foreach ($events->getItems() as $event) {
            $eventId = $event->getId();
            $googleEvents[$eventId] = [
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
                'calendarId' => $calendarId,
            ];
            $calendarEventIds[] = $eventId;
        }
    }

    // Obtener todos los GoogleEventId de la base de datos
    $sql_events = "SELECT * FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId IS NOT NULL";
    $result_events = mysqli_query($conn, $sql_events);

    if (!$result_events) {
        throw new Exception("Error en la consulta de eventos de la base de datos: " . mysqli_error($conn));
    }

    $dbEvents = [];
    while ($row_event = mysqli_fetch_assoc($result_events)) {
        $dbEvents[$row_event['GoogleEventId']] = $row_event;
    }

    // Comparar eventos de Google Calendar con los de la base de datos
    foreach ($googleEvents as $googleEventId => $googleEventData) {
        if (isset($dbEvents[$googleEventId])) {
            // Evento existe en ambas partes: Verificar si hubo cambios (edición)
            $dbEvent = $dbEvents[$googleEventId];
            if ($googleEventData['summary'] != $dbEvent['Nombre_Paciente'] || $googleEventData['start'] != $dbEvent['Fecha'] . 'T' . $dbEvent['Hora']) {
                // Registrar edición
                registrarMovimiento($conn, $dbEvent, 'Editado');
            }
            unset($dbEvents[$googleEventId]); // Marcar como procesado
        } else {
            // Evento existe en Google pero no en la base de datos: Registrar creación
            registrarMovimiento($conn, $googleEventData, 'Creado', true);
        }
    }

    // Los eventos restantes en $dbEvents no existen en Google Calendar (eliminados)
    foreach ($dbEvents as $dbEvent) {
        registrarMovimiento($conn, $dbEvent, 'Eliminado');
        $deleteSql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '{$dbEvent['GoogleEventId']}'";
        mysqli_query($conn, $deleteSql);
    }

    file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Sincronización completada para todos los calendarios registrados." . PHP_EOL, FILE_APPEND);
}

function registrarMovimiento($conn, $evento, $accion, $esNuevo = false) {
    if ($esNuevo) {
        // Si es un evento nuevo, extraer datos del array proporcionado por Google
        $especialista = 'Desconocido'; // Puedes modificar para obtener datos relevantes
        $nombrePaciente = $evento['summary'];
        $fechaHora = $evento['start'];
        $calendarId = $evento['calendarId'];
    } else {
        // Datos existentes en la base de datos
        $especialista = $evento['Fk_Especialista'];
        $nombrePaciente = $evento['Nombre_Paciente'];
        $fechaHora = $evento['Fecha'] . ' ' . $evento['Hora'];
        $calendarId = $evento['IDGoogleCalendar'];
    }

    // Insertar en MovimientosAgenda
    $sql = "INSERT INTO MovimientosAgenda (
                Fk_Especialista, Nombre_Paciente, Fecha_Hora, Accion, IDGoogleCalendar
            ) VALUES (
                '$especialista', '$nombrePaciente', '$fechaHora', '$accion', '$calendarId'
            )";

    if (!mysqli_query($conn, $sql)) {
        file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Error al registrar movimiento ($accion): " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
    } else {
        file_put_contents('webhook.log', date('Y-m-d H:i:s') . " - Movimiento registrado ($accion) para $nombrePaciente" . PHP_EOL, FILE_APPEND);
    }
}

?>
