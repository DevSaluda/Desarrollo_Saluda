<?php
include("db_connection.php");

// Leer la entrada JSON correctamente
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibió ninguna carga útil válida.']);
    exit;
}

// Validar que los datos existen
$requiredFields = ['idProducto', 'idProcedimiento', 'nuevaCantidad'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (!isset($data[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos.',
        'missing_fields' => $missingFields
    ]);
    exit;
}

$idProducto = intval($data['idProducto']);
$idProcedimiento = intval($data['idProcedimiento']);
$nuevaCantidad = intval($data['nuevaCantidad']);

// Validar que la cantidad sea válida
if ($nuevaCantidad <= 0) {
    echo json_encode(['success' => false, 'message' => 'La cantidad debe ser mayor a 0.']);
    exit;
}

// Actualizar la cantidad en la base de datos
$sql = "UPDATE Insumos SET Cantidad = ? WHERE ID_Insumo = ? AND FK_Procedimiento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $nuevaCantidad, $idProducto, $idProcedimiento);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
}

$stmt->close();
$conn->close();
?>
