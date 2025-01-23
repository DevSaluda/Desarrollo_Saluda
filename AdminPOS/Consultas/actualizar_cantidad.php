<?php
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['idProducto'], $data['idCarrito'], $data['nuevaCantidad'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

$idProducto = intval($data['idProducto']);
$idCarrito = intval($data['idCarrito']);
$nuevaCantidad = intval($data['nuevaCantidad']);

// Validar que la cantidad sea válida
if ($nuevaCantidad <= 0) {
    echo json_encode(['success' => false, 'message' => 'La cantidad debe ser mayor a 0.']);
    exit;
}

// Actualizar la cantidad en la base de datos
$sql = "UPDATE PRODUCTOS_EN_CARRITO SET CANTIDAD = ? WHERE ID_PRODUCTO = ? AND ID_CARRITO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $nuevaCantidad, $idProducto, $idCarrito);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
}
$stmt->close();
$conn->close();
?>
