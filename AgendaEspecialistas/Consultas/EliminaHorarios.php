<?php
include "../Consultas/db_connection.php";

if (isset($_POST['FechaSeleccionada']) && isset($_POST['horasSeleccionadas']) && is_array($_POST['horasSeleccionadas'])) {
    $fecha_id = $_POST['FechaSeleccionada']; // ID de la fecha seleccionada
    $horas_ids = $_POST['horasSeleccionadas']; // Array de horas seleccionadas

    // Iniciar una transacción para garantizar que todas las eliminaciones ocurran de manera atómica
    $conn->begin_transaction();

    try {
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conn->prepare("DELETE FROM Horarios_Citas_Ext WHERE ID_Horario = ? AND FK_Fecha = ?");
        
        // Bucle a través del array de horas seleccionadas y ejecutar la consulta
        foreach ($horas_ids as $hora_id) {
            $stmt->bind_param("ii", $hora_id, $fecha_id);  // Tipo 'i' para enteros
            $stmt->execute();
        }

        // Si todas las eliminaciones tuvieron éxito, confirmar la transacción
        $conn->commit();

        // Devolver una respuesta en formato JSON
        echo json_encode([
            "status" => "success",
            "message" => "Horas eliminadas correctamente"
        ]);

    } catch (Exception $e) {
        // Si hubo algún error, revertir la transacción
        $conn->rollback();

        // Devolver error en formato JSON
        echo json_encode([
            "status" => "error",
            "message" => "Error al eliminar las horas: " . $e->getMessage()
        ]);
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
} else {
    // Responder si los datos no están completos o el formato es incorrecto
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos o formato incorrecto: falta la fecha o las horas seleccionadas"
    ]);
}

$conn->close();
?>
