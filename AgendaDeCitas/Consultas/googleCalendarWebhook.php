<?php
include "db_connection.php";

// Extraer las cabeceras de la notificación
$resourceId = isset($_SERVER['HTTP_X_GOOG_RESOURCE_ID']) ? $_SERVER['HTTP_X_GOOG_RESOURCE_ID'] : null;
$resourceState = isset($_SERVER['HTTP_X_GOOG_RESOURCE_STATE']) ? $_SERVER['HTTP_X_GOOG_RESOURCE_STATE'] : null;
$eventType = isset($_SERVER['HTTP_X_GOOG_MESSAGE_NUMBER']) ? $_SERVER['HTTP_X_GOOG_MESSAGE_NUMBER'] : null;

// Verificar si se trata de un evento de eliminación
if ($resourceState === 'deleted' && $resourceId) {
    $GoogleEventId = $resourceId;

    // Eliminar la cita de la base de datos usando el GoogleEventId
    $sql = "DELETE FROM AgendaCitas_EspecialistasExt WHERE GoogleEventId = '$GoogleEventId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200, "message" => "Cita eliminada"));
    } else {
        echo json_encode(array("statusCode" => 500, "message" => "Error al eliminar la cita"));
    }
} else {
    echo json_encode(array("statusCode" => 400, "message" => "Evento no es una eliminación o no se encontró"));
}

mysqli_close($conn);
?>
