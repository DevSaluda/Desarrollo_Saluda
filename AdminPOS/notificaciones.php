<?php
require __DIR__ . '/vendor/autoload.php'; // Cargar dependencias de Composer

$options = array(
    'cluster' => 'us2',
    'useTLS' => true
);

$pusher = new Pusher\Pusher(
    'a2016098db0ef6ed7556', // Tu App Key de Pusher
    'f3a017df7a156a9b59a7', // Tu App Secret
    '1869631',              // Tu App ID
    $options
);

// Ejemplo de datos dinámicos
$data['title'] = 'Nuevo Usuario Agregado'; // Título de la notificación
$data['message'] = 'Se ha agregado un nuevo usuario a la base de datos.'; // Mensaje de la notificación
$data['url'] = 'http://tuurl.com/nuevo-usuario'; // URL a la que redirigir al hacer clic

// Disparar la notificación al canal "my-channel"
$pusher->trigger('my-channel', 'my-event', $data);

echo "Notificación enviada"; // Mensaje de confirmación
?>
