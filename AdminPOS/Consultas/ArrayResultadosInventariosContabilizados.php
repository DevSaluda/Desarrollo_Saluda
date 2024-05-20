<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Obtén la fecha actual en formato YYYY-MM-DD
$today = date('Y-m-d');

// Define la consulta SQL con la variable de fecha
$sql = "SELECT 
    ic.Cod_Barra, 
    ic.Nombre_Prod, 
    sc.Nombre_Sucursal AS Nombre_Sucursal,
    ic.Precio_Venta,
    ic.Precio_C,
    ic.Precio_Venta * ic.Contabilizado AS Total_Precio_Venta, 
    ic.Precio_C * ic.Contabilizado AS Total_Precio_Compra, 
    ic.Contabilizado, 
    ic.StockEnMomento, 
    ic.Diferencia, 
    ic.Sistema, 
    ic.AgregadoPor, 
    ic.AgregadoEl, 
    ic.ID_H_O_D, 
    ic.FechaInventario
FROM 
    InventariosStocks_Conteos AS ic
JOIN 
    SucursalesCorre AS sc ON ic.Fk_sucursal = sc.ID_SucursalC
WHERE 
    CAST(ic.FechaInventario AS DATE) = '$today';
";

// Ejecuta la consulta
$result = mysqli_query($conn, $sql);

$data = [];  // Asegúrate de inicializar el array $data
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $data[$c]["IdbD"] = $fila["Cod_Barra"];
    $data[$c]["Cod_Barra"] = $fila["Nombre_Prod"];
    $data[$c]["NombreSucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["PrecioVenta"] = $fila["Precio_Venta"];
    $data[$c]["PrecioCompra"] = $fila["Precio_C"];
    $data[$c]["TotalPrecioVenta"] = $fila["Total_Precio_Venta"];
    $data[$c]["TotalPrecioCompra"] = $fila["Total_Precio_Compra"];
    $data[$c]["Nombre_Prod"] = $fila["Contabilizado"];
    $data[$c]["Clave_interna"] = $fila["StockEnMomento"];
    $data[$c]["Clave_Levic"] = $fila["Diferencia"];
    $data[$c]["Cod_Enfermeria"] = $fila["AgregadoPor"];
    $data[$c]["FechaInventario"] = $fila["FechaInventario"];
    $c++;
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);

// Cierra la conexión
$conn->close();
?>
