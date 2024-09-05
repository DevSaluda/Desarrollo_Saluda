<?php
include "../Consultas/db_connection.php";

if (isset($_POST['fecha_id'])) {
    $fecha_id = $_POST['fecha_id'];

    // Obtener la hora asociada a la fecha seleccionada
    $sql = "SELECT Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE Fk_Fecha = '$fecha_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['hora' => $row['Horario_Disponibilidad']]);
    } else {
        echo json_encode(['hora' => '']);
    }
}
?>
