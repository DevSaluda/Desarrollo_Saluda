<?php
include("db_connection.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['idProducto'], $data['idCarrito'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

$idProducto = intval($data['idProducto']);
$idCarrito = intval($data['idCarrito']);

$sql = "DELETE FROM PRODUCTOS_EN_CARRITO WHERE ID_CARRITO = ? AND FK_Producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $idCarrito, $idProducto);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
}

$stmt->close();
$conn->close();
?>
