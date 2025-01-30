<?php
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_producto'], $data['id_procedimiento'], $data['cantidad'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

$id_producto = intval($data['id_producto']);
$id_procedimiento = intval($data['id_procedimiento']);
$cantidad = intval($data['cantidad']);

// Validar que la cantidad sea válida
if ($cantidad <= 0) {
    echo json_encode(['success' => false, 'message' => 'La cantidad debe ser mayor a 0.']);
    exit;
}

// Actualizar la cantidad en la base de datos
$sql = "UPDATE Insumos SET Cantidad = ? WHERE FK_Producto = ? AND FK_Procedimiento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $cantidad, $id_producto, $id_procedimiento);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
}

$stmt->close();
$conn->close();
?>
