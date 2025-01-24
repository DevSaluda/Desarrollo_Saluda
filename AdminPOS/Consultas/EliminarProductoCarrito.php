<?php
include("db_connection.php");

// Decodificar los datos enviados como JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validar que se proporcionaron los datos necesarios
if (!isset($data['idProducto'], $data['idCarrito'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

$idProducto = intval($data['idProducto']);
$idCarrito = intval($data['idCarrito']);

// Consulta para eliminar el producto del carrito
$sql = "DELETE FROM PRODUCTOS_EN_CARRITO WHERE ID_CARRITO = ? AND ID_PRODUCTO = ?";
$stmt = $conn->prepare($sql);

// Vincular los parámetros en el orden correcto
$stmt->bind_param("ii", $idCarrito, $idProducto);

// Ejecutar la consulta y responder al cliente
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
