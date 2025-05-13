<?php
include "../Consultas/db_connection.php";

if (isset($_POST['fecha_id'])) {
    $fecha_id = $_POST['fecha_id'];

    // Obtener el ID_Horario junto con la hora asociada a la fecha seleccionada
    $sql = "SELECT ID_Horario, Horario_Disponibilidad FROM Horarios_Citas_Ext WHERE FK_Fecha = '$fecha_id'";
    $result = $conn->query($sql);

    $horas = array();  // Crear un array para almacenar los resultados

    while ($row = $result->fetch_assoc()) {
        $horas[] = array(
            'ID_Horario' => $row['ID_Horario'], 
            'Horario_Disponibilidad' => $row['Horario_Disponibilidad']
        );
    }

    // Devolver el array de horas y IDs en formato JSON
    echo json_encode($horas);
}
?>
