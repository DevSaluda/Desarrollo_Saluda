<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Define la consulta SQL
$sql = "SELECT
sb.Id_Baja,
sb.ID_Prod_POS,
sb.Cod_Barra,
sb.Nombre_Prod,
sb.Fk_sucursal,
sc.Nombre_Sucursal,
sb.Precio_Venta,
sb.Precio_C,
sb.Cantidad,
sb.Lote,
sb.Fecha_Caducidad,
sb.MotivoBaja,
sb.AgregadoPor,
sb.AgregadoEl,
sb.ID_H_O_D,
sb.Estado,
(sb.Precio_C * sb.Cantidad) AS Total_Compra,
(sb.Precio_Venta * sb.Cantidad) AS Total_Venta
FROM
Stock_Bajas sb
JOIN
SucursalesCorre sc
ON
sb.Fk_sucursal = sc.ID_SucursalC
";

// Ejecuta la consulta
$result = mysqli_query($conn, $sql);

$data = [];  // Inicializa el array $data
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $estado = $fila["Estado"];
    
    if ($estado == "Caducado") {
        $estado = '<button style="background-color: #dc3545 !important;" class="btn btn-default btn-sm">Caducado</button>';
    } else if (empty($estado)) {
        $estado = '<button style="background-color: #dee2e6 !important;" class="btn btn-default btn-sm">Sin estado</button>';
    } else {
        $estado = '<button style="background-color: white; color: black; padding: 2px 4px; border-radius: 3px; border: none;" class="btn btn-default btn-sm">' . htmlspecialchars($estado) . '</button>';
    }
   
    



    $data[$c]["IdbD"] = $fila["Cod_Barra"];
    $data[$c]["Cod_Barra"] = $fila["Nombre_Prod"];
    $data[$c]["NombreSucursal"] = $fila["Nombre_Sucursal"];
    // $data[$c]["PrecioVenta"] = $fila["Precio_Venta"];
    // $data[$c]["PrecioCompra"] = $fila["Precio_C"];
    // $data[$c]["TotalPrecioVenta"] = $fila["Total_Venta"];
    // $data[$c]["TotalPrecioCompra"] = $fila["Total_Compra"];
    $data[$c]["Nombre_Prod"] = $fila["Cantidad"];
    $data[$c]["Clave_interna"] = $fila["Fecha_Caducidad"];
    $data[$c]["Clave_Levic"] = $fila["Lote"];
    $data[$c]["Cod_Enfermeria"] = $fila["MotivoBaja"];
    $data[$c]["FechaInventario"] = $fila["AgregadoPor"];
    $data[$c]["Estado"] = $estado; // Agrega el estado formateado, // Luego usa $estado para mostrar en la tabla o donde lo necesites
    $data[$c]["Acciones"] = '
    <td>
    <a data-id="' . $fila["Id_Baja"] . '" class="btn btn-success btn-sm btn-ActualizarCaducado"><i class="fas fa-times"></i></a> <br>
     <a data-id="' . $fila["Id_Baja"] . '" class="btn btn-warning btn-sm btn-GeneraRotacion"><i class="fas fa-people-carry"></i></a>
 
    
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

// Cierra la conexión
$conn->close();
?>
