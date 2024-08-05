<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Consulta SQL
$sql = "SELECT DISTINCT
    Sugerencias_POS.NumOrdPedido, 
    Sugerencias_POS.Fk_sucursal, 
    SucursalesCorre.Nombre_Sucursal, 
    DATE_FORMAT(Sugerencias_POS.AgregadoEl, '%Y-%m-%d') AS Fecha_Agregado
FROM 
    Sugerencias_POS
INNER JOIN 
    SucursalesCorre ON Sugerencias_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
WHERE 
    YEAR(Sugerencias_POS.Fecha_Ingreso) = YEAR(CURDATE()) -- Año actual
    AND MONTH(Sugerencias_POS.Fecha_Ingreso) = MONTH(CURDATE()) -- Mes actual
GROUP BY 
    Sugerencias_POS.NumOrdPedido, 
    Sugerencias_POS.Fk_sucursal, 
    SucursalesCorre.Nombre_Sucursal";

// Ejecutar la consulta
$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

// Procesar los resultados
while($fila = $result->fetch_assoc()) {
    $data[$c]["Pedido"] = $fila["NumOrdPedido"];
    $data[$c]["Nombre_Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Fecha_Agregado"] = $fila["Fecha_Agregado"];
   
    $data[$c]["Acciones"] = '
    <td>
        <a data-id="' . $fila["NumOrdPedido"] . '" data-sucursal="' . $fila["Fk_sucursal"] . '" class="btn btn-warning btn-sm btn-GeneraRotacion"><i class="fas fa-people-carry"></i></a>
        <a data-id="' . $fila["NumOrdPedido"] . '" data-sucursal="' . $fila["Fk_sucursal"] . '" class="btn btn-primary btn-sm btn-GeneraIngreso"><i class="fas fa-pills"></i></a>
    <a data-id="' . $fila["NumOrdPedido"] . '" data-sucursal="' . $fila["Fk_sucursal"] . '" class="btn btn-primary btn-sm btn-GeneraIngreso"><i class="fas fa-pills"></i></a>
        </td>';
  
    $c++;
}

// Estructura de la respuesta
$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

// Devolver la respuesta en formato JSON
echo json_encode($results);

// Cerrar la conexión
mysqli_close($conn);
?>
