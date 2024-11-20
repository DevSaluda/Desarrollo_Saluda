<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Obtiene la fecha actual en el formato 'YYYY-MM-DD'
$fechaActual = date("Y-m-d");

// Consulta SQL para obtener los datos de la tabla `Tickets_soporte`
$sql = "SELECT * FROM `Tickets_soporte`";

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
