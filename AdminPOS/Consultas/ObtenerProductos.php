<?php
include("db_connection.php");

$sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS";
$result = $conn->query($sql);

$productos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($productos);
?>
