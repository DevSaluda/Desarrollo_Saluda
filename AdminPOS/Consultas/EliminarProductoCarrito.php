<?php
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_carrito = isset($_POST['id_carrito']) ? intval($_POST['id_carrito']) : 0;
    $id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;

    if ($id_carrito > 0 && $id_producto > 0) {
        $sql = "
            DELETE FROM PRODUCTOS_EN_CARRITO 
            WHERE ID_CARRITO = $id_carrito AND FK_Producto = $id_producto
        ";

        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
