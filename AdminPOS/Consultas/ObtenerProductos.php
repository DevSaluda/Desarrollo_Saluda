<?php
include("db_connection.php");

// Verificar si se ha enviado el parámetro "nombre", "cod_barra" o "id_prod_pos"
if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $conn->real_escape_string($_GET['nombre']);
    $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS WHERE Nombre_Prod LIKE '%$nombre%'";
} elseif (isset($_GET['cod_barra']) && !empty($_GET['cod_barra'])) {
    $cod_barra = $conn->real_escape_string($_GET['cod_barra']);
    $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS WHERE Cod_Barra LIKE '%$cod_barra%'";
} elseif (isset($_GET['id_prod_pos']) && !empty($_GET['id_prod_pos'])) {
    $id_prod_pos = intval($_GET['id_prod_pos']);
    $sql = "SELECT ID_Prod_POS, Nombre_Prod FROM Productos_POS WHERE ID_Prod_POS = $id_prod_pos";
} else {
    // Si no se envía ninguno de los parámetros, devolver todos los productos
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
