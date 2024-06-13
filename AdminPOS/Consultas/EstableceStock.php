<?php
// Conectar a la base de datos
require 'config.php';

$tipoAjuste = $_POST['tipoAjuste'];
$fkSucursal = $_POST['fkSucursal'];

// Verificar si el inventario inicial ya ha sido establecido
$query = $pdo->prepare("SELECT inventario_inicial_establecido FROM inventario_inicial_estado WHERE fkSucursal = ?");
$query->execute([$fkSucursal]);
$result = $query->fetch();

if ($result && $result['inventario_inicial_establecido']) {
    echo json_encode(['success' => false, 'message' => 'El inventario inicial ya ha sido establecido.']);
    exit;
}

// Código para establecer el inventario en 0
if ($tipoAjuste === 'Inventario inicial') {
    // Actualiza la tabla de inventario
    $updateInventario = $pdo->prepare("UPDATE inventarios SET stock = 0 WHERE fkSucursal = ?");
    $updateInventario->execute([$fkSucursal]);

    // Marca el inventario inicial como establecido
    $updateEstado = $pdo->prepare("INSERT INTO inventario_inicial_estado (fkSucursal, inventario_inicial_establecido) VALUES (?, TRUE) ON DUPLICATE KEY UPDATE inventario_inicial_establecido = TRUE");
    $updateEstado->execute([$fkSucursal]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ajuste no permitido.']);
}
?>
