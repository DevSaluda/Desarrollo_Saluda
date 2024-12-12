<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Obtén el número de ticket de la solicitud GET
$numeroTicket = isset($_GET['No_Ticket']) ? mysqli_real_escape_string($conn, $_GET['No_Ticket']) : null;

if (!$numeroTicket) {
    echo json_encode(["error" => "No se proporcionó un número de ticket válido."]);
    exit;
}

// Consulta SQL para obtener los datos del ticket
$sql = "SELECT * FROM `Tickets_Soporte` WHERE `No_Ticket` = '$numeroTicket'";

$result = mysqli_query($conn, $sql);

if ($result && $result->num_rows > 0) {
    // Si se encuentra el ticket, devuelve el primer resultado
    $fila = $result->fetch_assoc();
    $data = [
        "Id_Ticket" => $fila["Id_Ticket"],
        "No_Ticket" => $fila["No_Ticket"],
        "Sucursal" => $fila["Sucursal"],
        "Reportado_Por" => $fila["Reportado_Por"],
        "Fecha_Registro" => $fila["Fecha_Registro"],
        "Problematica" => $fila["Problematica"],
        "DescripcionProblematica" => $fila["DescripcionProblematica"],
        "Solucion" => $fila["Solucion"],
        "Estatus" => $fila["Estatus"]
    ];
} else {
    // Si no se encuentra el ticket, devuelve un mensaje de error
    $data = ["error" => "No se encontró un ticket con el número proporcionado."];
}

echo json_encode($data);
?>
