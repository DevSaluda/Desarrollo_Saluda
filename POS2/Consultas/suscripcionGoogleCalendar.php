<?php
require '../vendor/autoload.php';

$client = new Google_Client();
$client->setAuthConfig('../../app-saluda-966447541c3c.json');
$client->setScopes(Google_Service_Calendar::CALENDAR);
$service = new Google_Service_Calendar($client);

// Conectar a la base de datos
include "db_connection.php";

// Obtener todos los IDs de calendario de los especialistas2
$sql = "SELECT DISTINCT IDGoogleCalendar FROM Personal_Medico_Express WHERE IDGoogleCalendar IS NOT NULL";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $calendarId = $row['IDGoogleCalendar'];

        // Configurar el canal para recibir notificaciones para cada calendario
        $channel = new Google_Service_Calendar_Channel(array(
            'id' => uniqid(), // ID único para el canal
            'type' => 'web_hook',
            'address' => 'https://saludapos.com/POS2/Consultas/googleCalendarWebhook.php' // URL del webhook
        ));

        // Intentar suscribirse a las notificaciones del calendario
        try {
            $watchRequest = $service->events->watch($calendarId, $channel);
            file_put_contents('webhook_subscriptions.log', date('Y-m-d H:i:s') . " - Suscripción creada para calendario: " . $calendarId . PHP_EOL, FILE_APPEND);
            echo "Suscripción creada con éxito para el calendario $calendarId <br>";
        } catch (Exception $e) {
            echo 'Error al crear la suscripción para el calendario ' . $calendarId . ': ', $e->getMessage() . "<br>";
            file_put_contents('webhook_subscriptions.log', date('Y-m-d H:i:s') . " - Error al suscribirse al calendario $calendarId: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }
} else {
    echo "No se encontraron calendarios para suscribirse.";
}

// Cerrar conexión a la base de datos
mysqli_close($conn);
?>
