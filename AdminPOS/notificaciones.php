<?php
require __DIR__ . '/vendor/autoload.php'; // Asegúrate de que el autoload de Composer esté configurado

$options = array(
  'cluster' => 'us2',  // Reemplaza con tu clúster si es necesario
  'useTLS' => true     // TLS activado para mayor seguridad
);

$pusher = new Pusher\Pusher(
  'a2016098db0ef6ed7556',   // Tu App Key de Pusher
  'f3a017df7a156a9b59a7',   // Tu App Secret
  '1869631',                // Tu App ID
  $options
);

// Enviar una notificación al canal "my-channel" con el evento "my-event"
$data['message'] = 'hello world';  // El contenido de la notificación
$pusher->trigger('my-channel', 'my-event', $data);

echo "Notificación enviada";
?>
