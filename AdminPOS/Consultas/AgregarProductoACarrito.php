<?php
include("db_connection.php");

// Obtener datos de la solicitud
$id_carrito = isset($_POST['id_carrito']) ? intval($_POST['id_carrito']) : 0;
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;

if ($id_carrito <= 0 || $id_producto <= 0) {
    die("Datos no válidos.");
}

// Insertar el producto en el carrito
$sql_insertar = "INSERT INTO PRODUCTOS_EN_CARRITO (FK_Producto, ID_CARRITO, CANTIDAD)
                 VALUES ($id_producto, $id_carrito, 1)"; // Por defecto la cantidad es 1

if ($conn->query($sql_insertar) === TRUE) {
    echo "Producto agregado al carrito";
} else {
    echo "Error: " . $conn->error;
}
?>
