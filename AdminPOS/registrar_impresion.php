<?php
include_once 'Consultas/db_connection.php';

// Obtener los valores de la solicitud POST
$estado = $_POST['estado'];
$factura = $_POST['Factura'];
$nombreApellidos = $_POST['nombreApellidos'];

// Preparar la consulta SQL para insertar los datos
$sql = "INSERT INTO impresiones (estado, NumFactura, ImpresoPor) 
        VALUES ('$estado', '$factura', '$nombreApellidos')";

if ($conn->query($sql) === TRUE) {
    echo "Registro de impresión guardado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
