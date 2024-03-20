<?php
include "db_connection.php";

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el término de búsqueda (nombre o código de barras)
$searchTerm = $_GET['term'] ?? '';

// Consulta para obtener los nombres de los productos que coincidan con el término de búsqueda
$sql = "SELECT Nombre_Prod,Cod_Barra FROM Productos_POS WHERE Nombre_Prod LIKE '%$searchTerm%' OR Cod_Barra LIKE '%$searchTerm%'";

$result = $conn->query($sql);
$productos = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $productos[] = array(
            'id' => $row['Nombre_Prod'],
            'text' => $row['Nombre_Prod'],
            'cod_barra' => $row['Cod_Barra'] // Agregamos el código de barras al array de resultados
        );
    }
}

echo json_encode($productos);
?>