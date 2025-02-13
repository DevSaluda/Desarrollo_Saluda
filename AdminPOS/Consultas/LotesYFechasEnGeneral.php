<?php
header('Content-Type: application/json');
include("db_connection.php"); // Asegúrate de que este archivo tenga la conexión a la base de datos.

$sql = "SELECT 
        lp.id,
        lp.producto_id,
        lp.lote,
        lp.fecha_caducidad,
        lp.fecha_registro,
        lp.sucursal_id,
        lp.cantidad,
        lp.estatus,
        sp.Folio_Prod_Stock,
        sp.Cod_Barra,
        sp.Nombre_Prod,
        sp.Precio_Venta,
        sp.Precio_C,
        sc.ID_SucursalC,
        sc.Nombre_Sucursal
    FROM Lotes_Productos lp
    JOIN Stock_POS sp ON lp.producto_id = sp.Folio_Prod_Stock
    JOIN SucursalesCorre sc ON lp.sucursal_id = sc.ID_SucursalC
    WHERE YEAR(lp.fecha_registro) = YEAR(CURDATE())
";

$result = mysqli_query($conn, $sql);

$data = []; 
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $data[$c]["IdbD"] = $fila["id"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["NombreSucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    
    $data[$c]["Comentario"] =  $fila["lote"];
    $data[$c]["FechaInventario"] = $fila["fecha_caducidad"];
    $data[$c]["Tipo_Ajuste"] = $fila["estatus"];
    $data[$c]["PrecioVenta"] = $fila["Precio_Venta"];
    $data[$c]["PrecioCompra"] = $fila["Precio_C"];
    $data[$c]["TotalPrecioVenta"] = floatval($fila["Precio_Venta"]) * floatval($fila["cantidad"]);
    $data[$c]["TotalPrecioCompra"] = floatval($fila["Precio_C"]) * floatval($fila["cantidad"]);
    $data[$c]["HoraInventario"] = date("g:i A", strtotime($fila["fecha_registro"]));
    $c++;
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
$conn->close();
?>
