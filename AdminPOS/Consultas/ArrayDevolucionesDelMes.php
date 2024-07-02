<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT 
Sugerencias_POS.Id_Sugerencia, 
Sugerencias_POS.Cod_Barra, 
Sugerencias_POS.Nombre_Prod, 
Sugerencias_POS.Fk_sucursal, 
Sugerencias_POS.Precio_Venta, 
Sugerencias_POS.Precio_C, 
Sugerencias_POS.Cantidad, 
Sugerencias_POS.Fecha_Ingreso, 
Sugerencias_POS.FkPresentacion, 
Sugerencias_POS.Proveedor1, 
Sugerencias_POS.Proveedor2, 
Sugerencias_POS.AgregadoPor, 
Sugerencias_POS.AgregadoEl, 
Sugerencias_POS.ID_H_O_D,
SucursalesCorre.Nombre_Sucursal 
FROM 
Sugerencias_POS 
INNER JOIN 
SucursalesCorre ON Sugerencias_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
WHERE 
YEAR(Sugerencias_POS.Fecha_Ingreso) = YEAR(CURDATE()) -- Año actual
AND MONTH(Sugerencias_POS.Fecha_Ingreso) = MONTH(CURDATE()); -- Mes actual";

$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

while($fila = $result->fetch_assoc()) {
    $data[$c]["Id_Sugerencia"] = $fila["Id_Sugerencia"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Nombre_Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Precio_C"] = $fila["Precio_C"];
    $data[$c]["Cantidad"] = $fila["Cantidad"];
    $data[$c]["Fecha_Ingreso"] = date("d/m/Y", strtotime($fila["Fecha_Ingreso"]));
    $data[$c]["FkPresentacion"] = $fila["FkPresentacion"];
    $data[$c]["Proveedor1"] = $fila["Proveedor1"];
    $data[$c]["Proveedor2"] = $fila["Proveedor2"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["AgregadoEl"] = $fila["AgregadoEl"];
  
    $c++;
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);

mysqli_close($conn);
?>
