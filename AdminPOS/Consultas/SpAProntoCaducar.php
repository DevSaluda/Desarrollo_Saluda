<?php
header('Content-Type: application/json');
include("db_connection.php"); // Asegúrate de que este archivo tenga la conexión a la base de datos.

$sql = "CALL ObtenerProximasCaducidades()"; // Llamamos al SP
$result = mysqli_query($conn, $sql);

$data = []; 
$c = 0;

while ($fila = $result->fetch_assoc()) {
    $data[$c]["IdbD"] = $fila["id"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["NombreSucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Tipo_Ajuste"] = $fila["estatus"];
    $data[$c]["PrecioVenta"] = $fila["Precio_Venta"];
    $data[$c]["PrecioCompra"] = $fila["Precio_C"];
    $data[$c]["TotalPrecioVenta"] = $fila["Precio_Venta"] * $fila["cantidad"];
    $data[$c]["TotalPrecioCompra"] = $fila["Precio_C"] * $fila["cantidad"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Clave_interna"] = $fila["producto_id"];
    $data[$c]["Clave_Levic"] = $fila["lote"];
    $data[$c]["Comentario"] = "Lote: " . $fila["lote"];
    $data[$c]["Cod_Enfermeria"] = "N/A"; // Puedes modificarlo si tienes más datos

    $data[$c]["FechaInventario"] = $fila["fecha_caducidad"];
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
