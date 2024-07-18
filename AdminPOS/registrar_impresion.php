<?php
include_once 'Consultas/db_connection.php';

// Obtener el estado de la solicitud POST
$estado = $_POST['estado'];

// Insertar registro en la base de datos
$sql = "INSERT INTO impresiones (estado) VALUES ('$estado')";

if ($conn->query($sql) === TRUE) {
    echo "Registro de impresión guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
