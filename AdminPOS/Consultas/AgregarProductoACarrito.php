<?php
include("db_connection.php");

// Obtener datos de la solicitud y validar
$id_carrito = isset($_POST['id_carrito']) ? intval($_POST['id_carrito']) : 0;
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
$cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1; // Por defecto cantidad = 1

if ($id_carrito <= 0 || $id_producto <= 0 || $cantidad <= 0) {
    die("Datos no válidos. Asegúrate de que el carrito, producto y cantidad sean correctos.");
}

// Verificar si el producto ya está en el carrito
$sql_verificar = "SELECT CANTIDAD FROM PRODUCTOS_EN_CARRITO WHERE FK_Producto = ? AND ID_CARRITO = ?";
$stmt = $conn->prepare($sql_verificar);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ii", $id_producto, $id_carrito);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Producto ya existe en el carrito, actualizar la cantidad
    $sql_actualizar = "UPDATE PRODUCTOS_EN_CARRITO SET CANTIDAD = CANTIDAD + ? WHERE FK_Producto = ? AND ID_CARRITO = ?";
    $stmt = $conn->prepare($sql_actualizar);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iii", $cantidad, $id_producto, $id_carrito);

    if ($stmt->execute()) {
        echo "Cantidad actualizada en el carrito.";
    } else {
        echo "Error al actualizar el carrito: " . $conn->error;
    }
} else {
    // Insertar el producto como nuevo en el carrito
    $sql_insertar = "INSERT INTO PRODUCTOS_EN_CARRITO (FK_Producto, ID_CARRITO, CANTIDAD) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insertar);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iii", $id_producto, $id_carrito, $cantidad);

    if ($stmt->execute()) {
        echo "Producto agregado al carrito.";
    } else {
        echo "Error al agregar producto al carrito: " . $conn->error;
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
