<?php
include "../Consultas/db_connection.php";

if (isset($_POST['FechaSeleccionada']) && isset($_POST['HoraSeleccionada'])) {
    $fecha_id = $_POST['FechaSeleccionada']; // ID de la fecha seleccionada
    $hora_id = $_POST['HoraSeleccionada'];   // Hora actual seleccionada

    // Eliminar la hora en la base de datos
    $sql = "DELETE FROM Horarios_Citas_Ext 
            WHERE ID_Horario = '$hora_id' 
            AND FK_Fecha = '$fecha_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Hora eliminada correctamente";
    } else {
        echo "Error al eliminar la hora: " . $conn->error;
    }
}
?>
