<?php
include "db_connection.php";


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los nombres de los productos
$sql = "SELECT Nombre_Prod FROM Productos_POS";
$result = $conn->query($sql);
$productos = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = $row['Nombre_Prod'];
    }
}

// Devolver los nombres de los productos como un array JSON
echo json_encode($productos);
?>