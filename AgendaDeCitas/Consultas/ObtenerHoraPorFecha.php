<?php
include "../Consultas/db_connection.php";

if (isset($_POST['fecha_id'])) {
    $fecha_id = $_POST['fecha_id'];

    // Obtener las horas asociadas a la fecha seleccionada
    $sql = "SELECT Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE FK_Fecha = '$fecha_id'";
    $result = $conn->query($sql);

    $horas = array();  // Crear un array para almacenar todas las horas

    while ($row = $result->fetch_assoc()) {
        $horas[] = $row['Horario_Disponibilidad'];  // Agregar cada hora al array
    }

    // Devolver el array de horas en formato JSON
    echo json_encode($horas);
}
?>
