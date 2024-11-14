<?php
// conexion.php debería contener la conexión a la base de datos
include 'db_connection.php';

$query = "SELECT SucursalesCorre.ID_SucursalC AS id, SucursalesCorre.Nombre_Sucursal AS nombre 
          FROM InventariosStocks_Conteos 
          INNER JOIN SucursalesCorre ON InventariosStocks_Conteos.Fk_sucursal = SucursalesCorre.ID_SucursalC 
          WHERE InventariosStocks_Conteos.Tipo_Ajuste = 'Ajuste por cierre de inventario'";

$result = $conn->query($query);
$sucursales = [];

while ($row = $result->fetch_assoc()) {
    $sucursales[] = $row;
}

echo json_encode($sucursales);
?>
