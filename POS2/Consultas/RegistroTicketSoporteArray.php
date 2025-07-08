<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

session_start();

// Obtiene la sucursal del usuario logueado desde la sesión
$sucursalUsuario = isset($_SESSION['Sucursal']) ? $_SESSION['Sucursal'] : '';

// Consulta SQL para obtener los datos de la tabla `Tickets_soporte` solo de la sucursal del usuario
$sql = "SELECT * FROM `Tickets_Soporte` WHERE Sucursal = '" . $sucursalUsuario . "'";

$result = mysqli_query($conn, $sql);

$data = [];

if ($result && $result->num_rows > 0) {
    $c = 0;

    while ($fila = $result->fetch_assoc()) {
        $data[$c]["Id_Ticket"] = $fila["Id_Ticket"];
        $data[$c]["No_Ticket"] = $fila["No_Ticket"];
        $data[$c]["Sucursal"] = $fila["Sucursal"];
        $data[$c]["Reportado_Por"] = $fila["Reportado_Por"];
        $data[$c]["Fecha_Registro"] = $fila["Fecha_Registro"];
        $data[$c]["Problematica"] = $fila["Problematica"];
        $data[$c]["DescripcionProblematica"] = $fila["DescripcionProblematica"];
        $data[$c]["Solucion"] = $fila["Solucion"];
        $data[$c]["Estatus"] = $fila["Estatus"];

        $c++;
    }
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
?>
