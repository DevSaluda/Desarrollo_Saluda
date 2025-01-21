<?php
include("db_connection.php");

$sql = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod FROM Productos_POS";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

echo json_encode($productos);
?>
