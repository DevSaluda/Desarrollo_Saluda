<?php
header('Content-Type: application/json');
include("db_connection.php");

$sql = "SELECT ID_SucursalC, Nombre_Sucursal FROM SucursalesCorre";
$result = $conn->query($sql);

$sucursales = [];
while ($row = $result->fetch_assoc()) {
    $sucursales[] = [
        "ID_SucursalC" => $row["ID_SucursalC"],
        "Nombre_Sucursal" => $row["Nombre_Sucursal"]
    ];
}

echo json_encode($sucursales);
?>
