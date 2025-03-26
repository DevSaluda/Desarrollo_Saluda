<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se enviaron las variables 'mes' y 'anual'
if (isset($_POST['Mes']) && isset($_POST['anual'])) {
    $mes = $conn->real_escape_string($_POST['Mes']);
    $anual = $conn->real_escape_string($_POST['anual']);

    // Construye las fechas de inicio y fin basadas en el mes y el año
    $fechaInicio = "$anual-$mes-01"; // Primer día del mes
    $fechaFin = date("Y-m-t", strtotime($fechaInicio)); // Último día del mes

    // Consulta para filtrar registros por rango de fechas
    $sql = "SELECT * FROM `Registros_Energia` WHERE Fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'";
} else {
    // Si no se envían las variables, devuelve un error
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => [],
        "error" => "Por favor, proporciona un mes y un año válidos."
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