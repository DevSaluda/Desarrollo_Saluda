<?php
include_once 'db_connection.php';

if (!empty($_POST['Id_Ticket']) && !empty($_POST['Solucion']) && !empty($_POST['Estatus'])) {
    $idTicket = mysqli_real_escape_string($conn, $_POST['Id_Ticket']);
    $solucion = mysqli_real_escape_string($conn, $_POST['Solucion']);
    $estatus = mysqli_real_escape_string($conn, $_POST['Estatus']);

    $query = "UPDATE Tickets_Soporte SET Solucion = ?, Estatus = ? WHERE Id_Ticket = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $solucion, $estatus, $idTicket);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["statusCode" => 200]);
        } else {
            echo json_encode(["statusCode" => 201, "message" => "Error: " . mysqli_stmt_error($stmt)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["statusCode" => 201, "message" => "Error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["statusCode" => 400, "message" => "Todos los campos son obligatorios."]);
}

mysqli_close($conn);
?>
