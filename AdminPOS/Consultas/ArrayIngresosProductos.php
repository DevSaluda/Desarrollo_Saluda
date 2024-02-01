
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT 
    Stock_registrosNuevos.Folio_Ingreso,
    Stock_registrosNuevos.ID_Prod_POS,
    Stock_registrosNuevos.Fk_sucursal,
    Stock_registrosNuevos.Factura,
    Stock_registrosNuevos.Existencias_R,
    Stock_registrosNuevos.ExistenciaPrev,
    Stock_registrosNuevos.Recibido,
    Stock_registrosNuevos.AgregadoPor,
    Stock_registrosNuevos.AgregadoEl,
    SucursalesCorre.ID_SucursalC,
    SucursalesCorre.Nombre_Sucursal,
    Productos_POS.ID_Prod_POS,
    Productos_POS.Cod_Barra,
    Productos_POS.Nombre_Prod,
    Productos_POS.Precio_C,
    (Productos_POS.Precio_C * Stock_registrosNuevos.Recibido) AS totalfactura
FROM
    Stock_registrosNuevos
JOIN SucursalesCorre ON Stock_registrosNuevos.Fk_sucursal = SucursalesCorre.ID_SucursalC
JOIN Productos_POS ON Stock_registrosNuevos.ID_Prod_POS = Productos_POS.ID_Prod_POS 
WHERE Stock_registrosNuevos.Fk_sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$data = array();
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $data[$c]["Folio_Ingreso"] = $fila["Folio_Ingreso"];
    $data[$c]["Factura"] = $fila["Factura"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Precio_C"] = $fila["Precio_C"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["ExistenciaPrev"] = $fila["ExistenciaPrev"];
    $data[$c]["Recibido"] = $fila["Recibido"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["AgregadoEl"] = $fila["AgregadoEl"];
    $data[$c]["totalfactura"] = $fila["totalfactura"];
    $c++;
}

echo json_encode($data);
?>
