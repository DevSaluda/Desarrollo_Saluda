<?php
include_once 'db_connection.php';
header('Content-Type: application/json');

if (!empty($_POST['Id_Ticket']) && !empty($_POST['TipoTicket'])) {
    $id = intval($_POST['Id_Ticket']);
    $tipo = mysqli_real_escape_string($conn, $_POST['TipoTicket']);
    $sql = "UPDATE Tickets_Reportes SET TipoTicket = ? WHERE Id_Ticket = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $tipo, $id);
        if ($stmt->execute()) {
            echo json_encode(["statusCode" => 200, "message" => "Tipo de ticket actualizado"]);
        } else {
            echo json_encode(["statusCode" => 500, "message" => "Error al actualizar: " . $stmt->error]);
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
