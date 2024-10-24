<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT 
Devolucion_POS.ID_Registro, 
Devolucion_POS.Num_Factura, 
Devolucion_POS.Cod_Barra, 
Devolucion_POS.Nombre_Produc, 
Devolucion_POS.Cantidad, 
Devolucion_POS.Fk_Suc_Salida, 
Devolucion_POS.Motivo_Devolucion, 
Devolucion_POS.Fecha, 
Devolucion_POS.Agrego, 
Devolucion_POS.HoraAgregado, 
Devolucion_POS.NumOrde, 
Devolucion_POS.Estatus,
Devolucion_POS.Proveedor, 
SucursalesCorre.Nombre_Sucursal 
FROM 
Devolucion_POS 
INNER JOIN 
SucursalesCorre ON Devolucion_POS.Fk_Suc_Salida = SucursalesCorre.ID_SucursalC
WHERE 
YEAR(Devolucion_POS.Fecha) = YEAR(CURDATE()) -- Año actual
AND MONTH(Devolucion_POS.Fecha) = MONTH(CURDATE()); -- Mes actual";

$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $estatus = $fila["Estatus"];
    
    // Definir estilos para el botón según el estatus
    if ($estatus == "Devolucion") {
        $estatus = '<button style="background-color: #ffc107 !important;" class="btn btn-default btn-sm">Devolución</button>';
    } elseif (empty($estatus)) {
        $estatus = '<button style="background-color: white; color: black;" class="btn btn-default btn-sm">Sin Estatus</button>';
    } else {
        $estatus = '<button style="background-color: #28a745 !important; color: white;" class="btn btn-default btn-sm">' . htmlspecialchars($estatus) . '</button>';
    }

    // Asignación de los datos al array
    $data[$c]["NumOrde"] = $fila["NumOrde"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Produc"] = $fila["Nombre_Produc"];
    $data[$c]["Cantidad"] = $fila["Cantidad"];
    $data[$c]["Proveedor"] = $fila["Proveedor"];
    $data[$c]["Num_Factura"] = $fila["Num_Factura"];
    $data[$c]["Nombre_Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Motivo_Devolucion"] = $fila["Motivo_Devolucion"];
    $data[$c]["Fecha"] = date("d/m/Y", strtotime($fila["Fecha"]));
    $data[$c]["HoraAgregado"] = $fila["HoraAgregado"];
    $data[$c]["Agrego"] = $fila["Agrego"];
    $data[$c]["Estatus"] = $estatus; // Mostrar el botón según el estatus

    // Añadir botones de acción
    $data[$c]["Acciones"] = '
    <td>
        <a data-id="' . htmlspecialchars($fila["ID_Registro"], ENT_QUOTES, 'UTF-8') . '" class="btn btn-success btn-sm btn-Traspaso"><i class="fas fa-exchange-alt"></i></a>
        <a data-id="' . htmlspecialchars($fila["ID_Registro"], ENT_QUOTES, 'UTF-8') . '" class="btn btn-warning btn-sm btn-caducado"><i class="far fa-calendar-times"></i></a>
        <a data-id="' . htmlspecialchars($fila["ID_Registro"], ENT_QUOTES, 'UTF-8') . '" class="btn btn-info btn-sm btn-DevolucionDefinitiva"><i class="fa-solid fa-rotate-left"></i></a>
        <a data-id="' . htmlspecialchars($fila["ID_Registro"], ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary btn-sm btn-Devolucion"><i class="fa-solid fa-rotate-left"></i></a>
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
