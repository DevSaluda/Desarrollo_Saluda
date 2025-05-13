<?php
include "../Consultas/db_connection.php";

if (isset($_POST['FechaSeleccionada']) && isset($_POST['HoraSeleccionada']) && isset($_POST['NuevaHora'])) {
    $fecha_id = $_POST['FechaSeleccionada']; // ID de la fecha seleccionada
    $hora_id = $_POST['HoraSeleccionada'];   // Hora actual seleccionada
    $hora_nueva = $_POST['NuevaHora'];       // Nueva hora

    // Actualizar la hora en la base de datos
    $sql = "UPDATE Horarios_Citas_Ext 
            SET Horario_Disponibilidad = '$hora_nueva' 
            WHERE ID_Horario = '$hora_id' 
            AND FK_Fecha = '$fecha_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Hora actualizada correctamente";
    } else {
        echo "Error al actualizar la hora: " . $conn->error;
    }
}
?>
