<?php
include_once 'db_connection.php';
header('Content-Type: application/json');

if (!empty($_POST['Id_Ticket']) && !empty($_POST['Asignado'])) {
    $id = intval($_POST['Id_Ticket']);
    $asignado = mysqli_real_escape_string($conn, $_POST['Asignado']);
    $sql = "UPDATE Tickets_Reportes SET Asignado = ? WHERE Id_Ticket = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $asignado, $id);
        if ($stmt->execute()) {
            echo json_encode(["statusCode" => 200, "message" => "Ticket asignado"]);
        } else {
            echo json_encode(["statusCode" => 500, "message" => "Error al asignar: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["statusCode" => 500, "message" => "Error en prepare: " . $conn->error]);
    }
} else {
    echo json_encode(["statusCode" => 400, "message" => "Datos incompletos"]);
}
$conn->close();
?>