<?php
include "db_connection.php";
// Obtener datos del POST



$tipoAjuste = $_POST['tipoAjuste'];
$fkSucursal = $_POST['fkSucursal'];

if ($tipoAjuste === 'Inventario inicial') {
    // Actualiza la tabla de inventario
    $updateInventario = "UPDATE Stock_POS SET Existencias_R = 0 WHERE Fk_sucursal = ?";
    $stmt = $conn->prepare($updateInventario);
    $stmt->bind_param("i", $fkSucursal);
    $stmt->execute();

    // Marca el inventario inicial como establecido y registra la fecha
    $updateEstado = "INSERT INTO inventario_inicial_estado (fkSucursal, inventario_inicial_establecido, fecha_establecido) VALUES (?, TRUE, NOW())";
    $stmt = $conn->prepare($updateEstado);
    $stmt->bind_param("i", $fkSucursal);
    $stmt->execute();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ajuste no permitido.']);
}
?>