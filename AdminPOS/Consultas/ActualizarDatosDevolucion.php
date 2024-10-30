<?php
include 'db_connection.php'; // Asegúrate de incluir la conexión a la base de datos

if (isset($_POST['GeneradoPor'], $_POST['Movimiento'], $_POST['IdDevuelve'])) {
    $actualizadoPor = $_POST['GeneradoPor'];
    $estatus= $_POST['Movimiento'];
    $idRegistro = $_POST['IdDevuelve'];
   

    // Consulta para actualizar la tabla Devolucion_POS
    $sql = "UPDATE Devolucion_POS 
            SET ActualizadoPor = ?, Estatus = ?
            WHERE ID_Registro = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $actualizadoPor, $estatus, $idRegistro);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Registro actualizado exitosamente."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Error al actualizar el registro."
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error en la preparación de la consulta."
        ]);
    }

    $conn->close();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos en el formulario."
    ]);
}
?>
