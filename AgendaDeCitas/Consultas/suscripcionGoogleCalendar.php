<?php
require '../vendor/autoload.php'; // Asegúrate de tener el cliente de Google API cargado (puedes instalarlo con Composer)

$client = new Google_Client();
$client->setAuthConfig('../../app-saluda-966447541c3c.json'); // Credenciales del cliente
$client->setScopes(Google_Service_Calendar::CALENDAR);
$service = new Google_Service_Calendar($client);

$calendarId = '3dc95b55f97f949efe5e01222ec074eeccd45eb10888e94b4a2fc39c91a60dc4@group.calendar.google.com'; // Reemplaza con el ID de tu calendario

// Configurar el canal para recibir notificaciones
$channel = new Google_Service_Calendar_Channel(array(
    'id' => uniqid(), // Generar un ID único para cada canal
    'type' => 'web_hook',
    'address' => 'https://saludapos.com/AgendaDeCitas/Consultas/googleCalendarWebhook.php' // URL del webhook
));

// Suscribirse a las notificaciones del calendario
try {
    $watchRequest = $service->events->watch($calendarId, $channel);
    print_r($watchRequest); // Verificar la respuesta de la suscripción
    echo "Suscripción creada con éxito";
} catch (Exception $e) {
    echo 'Error al crear la suscripción: ', $e->getMessage();
    
}
