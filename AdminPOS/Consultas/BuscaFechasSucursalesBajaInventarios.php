<?php
include 'db_connection.php';

$sucursal_id = $_GET['sucursal_id'];

$query = "SELECT DISTINCT FechaInventario FROM InventariosStocks_Conteos 
          WHERE Fk_sucursal = ? AND Tipo_Ajuste = 'Ajuste por cierre de inventario'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $sucursal_id);
$stmt->execute();
$result = $stmt->get_result();
$fechas = [];

while ($row = $result->fetch_assoc()) {
    $fechas[] = $row['FechaInventario'];
}

echo json_encode($fechas);
?>
