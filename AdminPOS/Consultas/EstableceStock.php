<?php
include "db_connection.php";
// Obtener datos del POST


$tipoAjuste = $_POST['tipoAjuste'];
$fkSucursal = $_POST['fkSucursal'];

// Verificar si el inventario inicial ya ha sido establecido
$query = "SELECT inventario_inicial_establecido FROM inventario_inicial_estado WHERE fkSucursal = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $fkSucursal);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && $row['inventario_inicial_establecido']) {
    echo json_encode(['success' => false, 'message' => 'El inventario inicial ya ha sido establecido.']);
    exit;
}

// Código para establecer el inventario en 0
if ($tipoAjuste === 'Inventario inicial') {
    // Actualiza la tabla de inventario
    $updateInventario = "UPDATE inventarios SET stock = 0 WHERE fkSucursal = ?";
    $stmt = $conn->prepare($updateInventario);
    $stmt->bind_param("i", $fkSucursal);
    $stmt->execute();

    // Marca el inventario inicial como establecido
    $updateEstado = "INSERT INTO inventario_inicial_estado (fkSucursal, inventario_inicial_establecido) VALUES (?, TRUE) ON DUPLICATE KEY UPDATE inventario_inicial_establecido = TRUE";
    $stmt = $conn->prepare($updateEstado);
    $stmt->bind_param("i", $fkSucursal);
    $stmt->execute();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ajuste no permitido.']);
}
?>
