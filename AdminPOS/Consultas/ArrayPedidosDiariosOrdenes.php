<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT 
    Sugerencias_POS.NumOrdPedido, 
    SucursalesCorre.Nombre_Sucursal, 
    Sugerencias_POS.AgregadoEl
FROM 
    Sugerencias_POS
INNER JOIN 
    SucursalesCorre ON Sugerencias_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
WHERE 
    YEAR(Sugerencias_POS.Fecha_Ingreso) = YEAR(CURDATE()) -- Año actual
    AND MONTH(Sugerencias_POS.Fecha_Ingreso) = MONTH(CURDATE()) -- Mes actual
GROUP BY 
    Sugerencias_POS.NumOrdPedido, 
    SucursalesCorre.Nombre_Sucursal";

$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

while($fila = $result->fetch_assoc()) {
    $data[$c]["Id_Sugerencia"] = $fila["NumOrdPedido"];
    $data[$c]["Cod_Barra"] = $fila["Nombre_Sucursal"];
    $data[$c]["Nombre_Prod"] = $fila["AgregadoEl"];
    $data[$c]["Acciones"] = '
    <td>
    <a data-id="' . $fila["NumOrdPedido"] . '" class="btn btn-success btn-sm btn-ActualizarCaducado"><i class="fas fa-times"></i></a> <br><br>
     <a data-id="' . $fila["NumOrdPedido"] . '" class="btn btn-warning btn-sm btn-GeneraRotacion"><i class="fas fa-people-carry"></i></a>
  
    </td>';
  
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
