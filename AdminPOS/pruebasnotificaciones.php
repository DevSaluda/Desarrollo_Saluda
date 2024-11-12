<?php include "notificaciones.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
    <h1>Pusher Test</h1>
    <p>
        Intenta publicar un evento en el canal <code>my-channel</code> con el nombre de evento <code>my-event</code>.
    </p>

    <script>
        // Solicitar permisos para notificaciones
        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    console.log("Permisos concedidos para notificaciones.");
                }
            });
        }

        // Configuración de Pusher
        var pusher = new Pusher('a2016098db0ef6ed7556', {
            cluster: 'us2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // Verificar el permiso antes de mostrar la notificación
            if (Notification.permission === "granted") {
                // Crear una notificación dinámica con el contenido del evento
                var notification = new Notification(data.title, {
                    body: data.message, // Mensaje dinámico recibido del servidor
                    icon: 'path/to/icon.png' // Especifica el ícono si lo deseas
                });

                // Agregar un evento al hacer clic en la notificación
                notification.onclick = function() {
                    window.open(data.url); // Puedes redirigir a una URL específica al hacer clic
                };
            }
        });
    </script>
</body>
</html>
