<?php
include "../Consultas/db_connection.php";

if (isset($_POST['FechaSeleccionada']) && isset($_POST['HoraSeleccionada'])) {
    $fecha_id = $_POST['FechaSeleccionada']; // ID de la fecha seleccionada
    $hora_nueva = $_POST['HoraSeleccionada']; // Nueva hora seleccionada
    
    // Actualizar la hora en la base de datos
    $sql = "UPDATE Fechas_EspecialistasExt SET Hora_Disponibilidad = '$hora_nueva' WHERE ID_Fecha_Esp = '$fecha_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Hora actualizada correctamente";
    } else {
        echo "Error al actualizar la hora: " . $conn->error;
    }
}
?>
