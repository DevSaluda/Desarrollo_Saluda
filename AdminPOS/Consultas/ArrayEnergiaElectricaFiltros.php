<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se enviaron las fechas de inicio y fin
if (isset($_POST['fechaInicio']) && isset($_POST['fechaFin'])) {
    $fechaInicio = $conn->real_escape_string($_POST['fechaInicio']);
    $fechaFin = $conn->real_escape_string($_POST['fechaFin']);

    // Consulta para filtrar registros por rango de fechas
    $sql = "SELECT * FROM `Registros_Energia` WHERE Fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'";
} else {
    // Si no se envían fechas, devuelve un error
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => [],
        "error" => "Por favor, proporciona un rango de fechas válido."
    ]);
    exit;
}

$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

// Procesa los resultados de la consulta
while ($fila = $result->fetch_assoc()) {
    $data[$c]["Id_Registro"] = $fila["Id_Registro"];
    $data[$c]["Registro_energia"] = $fila["Registro_energia"];
    $data[$c]["Fecha_registro"] = $fila["Fecha_registro"];
    $data[$c]["Sucursal"] = $fila["Sucursal"];
    $data[$c]["Comentario"] = $fila["Comentario"];
    $data[$c]["Registrado"] = $fila["Registro"];
    $data[$c]["Horaregistro"] = $fila["Agregadoel"];
    $c++;
}

// Construye la respuesta en formato JSON
$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
];

echo json_encode($results);
?>