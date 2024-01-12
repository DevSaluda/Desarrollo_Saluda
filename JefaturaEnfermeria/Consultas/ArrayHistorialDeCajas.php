<?php
header('Content-Type: application/json');
include("db_connection.php");

// Incluye las demás clases y funciones necesarias
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

// Evita la inyección SQL utilizando consultas preparadas
$sql = "SELECT Cajas_POS.ID_Caja, Cajas_POS.Cantidad_Fondo, Cajas_POS.Empleado, Cajas_POS.Turno, Cajas_POS.Sucursal, Cajas_POS.Estatus,
Cajas_POS.CodigoEstatus, Cajas_POS.Fecha_Apertura, Cajas_POS.Valor_Total_Caja, Cajas_POS.ID_H_O_D,
SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal
FROM Cajas_POS
JOIN SucursalesCorre ON Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC 
WHERE Cajas_POS.ID_H_O_D = ?
AND YEAR(Cajas_POS.Fecha_Apertura) = YEAR(NOW())
ORDER BY Cajas_POS.Fecha_Apertura DESC";

// Prepara la consulta
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . mysqli_error($conn));
}

// Asocia el parámetro
$id_h_o_d = $row['ID_H_O_D'];
mysqli_stmt_bind_param($stmt, 's', $id_h_o_d);

// Ejecuta la consulta
$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die('Error en la ejecución de la consulta: ' . mysqli_error($conn));
}

// Obtiene los resultados
$result = mysqli_stmt_get_result($stmt);

// Inicializa el array de datos
$data = [];

// Recorre los resultados
while ($fila = mysqli_fetch_assoc($result)) {
    $data[$c]["IdCaja"] = $fila["ID_Caja"];
    $data[$c]["Empleado"] = $fila["Empleado"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["Fondodecaja"] = $fila["Cantidad_Fondo"];
    $data[$c]["Fecha"] = $fila["Fecha_Apertura"];
   
    $data[$c]["Estatus"]= '<button class="btn btn-default btn-sm" style="' . htmlspecialchars($fila["CodigoEstatus"]) . '">' . htmlspecialchars($fila["Estatus"]) . '</button>';
    $data[$c]["Cantidadalcierre"] = $fila["Valor_Total_Caja"];
   
    $data[$c]["Acciones"] = '<div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-th-list fa-1x"></i>
    </button>
    <div class="dropdown-menu">
      <a data-id="' . htmlspecialchars($fila["ID_Caja"]) . '" class="btn-Movimientos dropdown-item">Historial caja <i class="fas fa-history"></i></a>
      <a data-id="' . htmlspecialchars($fila["ID_Caja"]) . '" class="btn-Ventas dropdown-item">Ventas realizadas en caja<i class="fas fa-receipt"></i></a>
      <a data-id="' . htmlspecialchars($fila["ID_Caja"]) . '" style="' . ($fila['Estatus'] == 'Abierta' ? 'display:block;' : 'display:none;') . '" class="btn-Cortes dropdown-item">Realizar Corte<i class="fas fa-cash-register"></i></a>
    </div>
  </div>';
    
    $c++;
}

// Prepara el resultado para la respuesta JSON
$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

// Devuelve la respuesta JSON
echo json_encode($results);
?>
