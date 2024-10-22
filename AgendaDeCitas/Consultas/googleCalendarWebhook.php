<?php
include "db_connection.php";

// Capturar el cuerpo de la solicitud (notificación)
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Verificar si la notificación contiene la información del evento eliminado
if (isset($data['event']) && $data['event'] == 'deleted') {
    $GoogleEventId = $data['resourceId'];

    // Eliminar la cita de la base de datos usando el GoogleEventId
    $sql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '$GoogleEventId'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200, "message" => "Cita eliminada"));
    } else {
        echo json_encode(array("statusCode" => 500, "message" => "Error al eliminar la cita"));
    }
} else {
    echo json_encode(array("statusCode" => 400, "message" => "Evento no encontrado o no es una eliminación"));
}

mysqli_close($conn);
?>
