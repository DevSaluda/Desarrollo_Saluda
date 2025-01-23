<?php
include("db_connection.php");

// Verificar si se ha enviado el parámetro "busqueda"
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    $busqueda = $conn->real_escape_string($_GET['busqueda']);

    // Verificar si es un número para buscar en ID o código de barra
    if (is_numeric($busqueda)) {
        $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS 
                WHERE ID_Prod_POS = '$busqueda' OR Cod_Barra LIKE '%$busqueda%'";
    } else {
        // Buscar por nombre de producto
        $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS 
                WHERE Nombre_Prod LIKE '%$busqueda%'";
    }
} else {
    // Si no se envía ningún parámetro de búsqueda, devolver todos los productos
    $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS";
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
