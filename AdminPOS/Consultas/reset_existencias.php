<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Consulta SQL para actualizar existencias
$sql = "UPDATE Stock_POS SET Existencias_R = 0 WHERE Cod_Barra = 'PAPE-0069' AND Fk_sucursal = 24";

if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente\n";
    // Registrar la ejecución en un archivo de log
    file_put_contents("cron_log.txt", "Cron ejecutado correctamente: " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
} else {
    echo "Error al actualizar: " . $conn->error . "\n";
    file_put_contents("cron_log.txt", "Error en ejecución: " . $conn->error . " - " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
}

// Cerrar conexión
$conn->close();
?>
