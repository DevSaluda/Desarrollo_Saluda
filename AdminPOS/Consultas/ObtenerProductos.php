<?php
include("db_connection.php");

// Asegurar que no se envíen caracteres adicionales
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$sql = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod FROM Productos_POS";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Enviar respuesta JSON limpia
echo json_encode($productos, JSON_UNESCAPED_UNICODE);
?>
