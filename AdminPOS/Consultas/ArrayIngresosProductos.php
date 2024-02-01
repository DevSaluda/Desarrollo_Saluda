
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
Productos_POS.Precio_C
FROM
Stock_registrosNuevos
JOIN SucursalesCorre ON Stock_registrosNuevos.Fk_sucursal = SucursalesCorre.ID_SucursalC
JOIN Productos_POS ON Stock_registrosNuevos.ID_Prod_POS = Productos_POS.ID_Prod_POS AND Stock_registrosNuevos.Fk_sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio_Ingreso"] = $fila["Folio_Ingreso"];
    $data[$c]["Factura"] = $fila["Factura"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["ExistenciaPrev"] = $fila["ExistenciaPrev"];
    $data[$c]["Recibido"] = $fila["Recibido"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["AgregadoEl"] = $fila["AgregadoEl"];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
