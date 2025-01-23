<?php
include("db_connection.php");

// Verificar si se ha enviado el parámetro "nombre"
if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $conn->real_escape_string($_GET['nombre']); // Sanitizar el parámetro para evitar inyección SQL

    // Modificar la consulta para buscar productos que coincidan con el nombre
    $sql = "SELECT ID_Prod_POS, Nombre_Prod 
            FROM Productos_POS 
            WHERE Nombre_Prod LIKE '%$nombre%'";
} else {
    // Si no se envía el parámetro, devolver todos los productos
    $sql = "SELECT ID_Prod_POS, Nombre_Prod 
            FROM Productos_POS";
}

$result = $conn->query($sql);

$productos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Establecer el encabezado de respuesta como JSON
header('Content-Type: application/json');

// Devolver el resultado como JSON
echo json_encode($productos);
?>
