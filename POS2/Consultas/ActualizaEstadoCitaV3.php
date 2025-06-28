<?php
// Actualiza el estado de una cita externa
include("db_connection.php");

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';

if ($id > 0 && in_array($estado, ['Pendiente', 'Confirmado'])) {
    $stmt = $conn->prepare("UPDATE AgendaCitas_EspecialistasExt SET Estatus_cita=? WHERE ID_Agenda_Especialista=?");
    $stmt->bind_param('si', $estado, $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'estado' => $estado]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo actualizar']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
}
$conn->close();
