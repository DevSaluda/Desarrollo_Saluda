<?php
$url = 'http://localhost:8080/ticket/TicketVenta.php'; // URL del servidor local
$data = $_POST; // Datos que se reciben del cliente

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
?>
