<?php
include("db_connection.php");

// Decodificar los datos enviados como JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validar que se proporcionaron los datos necesarios
if (!isset($data['idProducto'], $data['idProcedimiento'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

$idProducto = intval($data['idProducto']);
$idProcedimiento = intval($data['idProcedimiento']);

// Consulta para eliminar el producto del procedimiento
$sql = "DELETE FROM Insumos WHERE FK_Procedimiento = ? AND ID_Insumo = ?";
$stmt = $conn->prepare($sql);

// Vincular los parámetros en el orden correcto
$stmt->bind_param("ii", $idProcedimiento, $idProducto);

// Ejecutar la consulta y responder al cliente
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
