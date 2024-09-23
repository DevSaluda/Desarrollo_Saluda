<?php include "notificaciones";?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    // Habilitar el log de Pusher (solo para pruebas, no lo uses en producción)
    Pusher.logToConsole = true;

    // Inicializar Pusher con tus credenciales
    var pusher = new Pusher('a2016098db0ef6ed7556', {
      cluster: 'us2'
    });

    // Suscribirse al canal
    var channel = pusher.subscribe('my-channel');

    // Escuchar el evento "my-event"
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data)); // Mostrar la notificación en el navegador
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Intenta publicar un evento en el canal <code>my-channel</code> con el nombre de evento <code>my-event</code>.
  </p>
</body>
</html>
