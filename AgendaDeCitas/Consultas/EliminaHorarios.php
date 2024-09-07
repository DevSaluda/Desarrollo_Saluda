<?php
include "../Consultas/db_connection.php";

if (isset($_POST['FechaSeleccionada']) && isset($_POST['HoraSeleccionada'])) {
    $fecha_id = $_POST['FechaSeleccionada']; // ID de la fecha seleccionada
    $hora_id = $_POST['HoraSeleccionada'];   // Hora seleccionada

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM Horarios_Citas_Ext WHERE ID_Horario = ? AND FK_Fecha = ?");
    $stmt->bind_param("ii", $hora_id, $fecha_id);  // Tipo 'i' para enteros
    
    if ($stmt->execute()) {
        // Devolver una respuesta en formato JSON
        echo json_encode([
            "status" => "success",
            "message" => "Hora eliminada correctamente"
        ]);
    } else {
        // Devolver error en formato JSON
        echo json_encode([
            "status" => "error",
            "message" => "Error al eliminar la hora: " . $stmt->error
        ]);
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
} else {
    // Responder si los datos no están completos
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos: falta la fecha o la hora"
    ]);
}
$conn->close();
?>
