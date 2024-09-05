<?php
include "../Consultas/db_connection.php";

if (isset($_POST['fecha_id'])) {
    $fecha_id = $_POST['fecha_id'];

    // Obtener la hora asociada a la fecha seleccionada
    $sql = "SELECT Hora_Disponibilidad FROM Fechas_EspecialistasExt WHERE ID_Fecha_Esp = '$fecha_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['hora' => $row['Hora_Disponibilidad']]);
    } else {
        echo json_encode(['hora' => '']);
    }
}
?>
