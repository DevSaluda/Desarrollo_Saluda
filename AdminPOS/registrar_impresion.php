<?php
include_once 'Consultas/db_connection.php';

// Obtener los valores de la solicitud POST
$estado = $_POST['estado'];
$factura = $_POST['Factura'];
$nombreApellidos = $_POST['nombreApellidos'];

// Verificar si ya existe un registro con la misma NumFactura
$sql_check = "SELECT contador FROM impresiones WHERE NumFactura = '$factura' ORDER BY contador DESC LIMIT 1";
$result = $conn->query($sql_check);

if ($result && $result->num_rows > 0) {
    // Si existe, incrementar el contador
    $row = $result->fetch_assoc();
    $contador = $row['contador'] + 1;
} else {
    // Si no existe, iniciar contador en 1
    $contador = 1;
}

// Preparar la consulta SQL para insertar los datos
$sql_insert = "INSERT INTO impresiones (estado, NumFactura, ImpresoPor, contador) 
               VALUES ('$estado', '$factura', '$nombreApellidos', '$contador')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Registro de impresión guardado exitosamente";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
