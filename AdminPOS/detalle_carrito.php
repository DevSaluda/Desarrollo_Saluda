<?php
include("db_connection.php");

// Obtener el ID del carrito de la URL
$id_carrito = isset($_GET['id_carrito']) ? intval($_GET['id_carrito']) : 0;

// Verificar si se ha proporcionado un ID de carrito válido
if ($id_carrito <= 0) {
    die("ID de carrito no válido.");
}

// Obtener los detalles del carrito (opcional para el título)
$sql_carrito = "
    SELECT ID_CARRITO 
    FROM CarritosEnfermeria
    WHERE ID_CARRITO = $id_carrito
";
$result_carrito = $conn->query($sql_carrito);
if ($result_carrito && $result_carrito->num_rows > 0) {
    $carrito = $result_carrito->fetch_assoc();
} else {
    die("No se encontró el carrito.");
}

// Obtener productos en el carrito
$sql_productos = "
    SELECT 
        pc.ID_PRODUCTO,
        p.Nombre_Prod,
        pc.CANTIDAD
    FROM 
        PRODUCTOS_EN_CARRITO AS pc
    INNER JOIN 
        Productos_POS AS p
    ON 
        pc.FK_Producto = p.ID_Prod_POS
    WHERE 
        pc.ID_CARRITO = $id_carrito
";
$result_productos = $conn->query($sql_productos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Carrito</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Detalle del Carrito N° <?php echo $carrito['ID_CARRITO']; ?></h2>

        <h3>Productos en el carrito</h3>
        <?php if ($result_productos->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre del Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($producto = $result_productos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $producto['ID_PRODUCTO']; ?></td>
                            <td><?php echo $producto['Nombre_Prod']; ?></td>
                            <td><?php echo $producto['CANTIDAD']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">No hay productos en este carrito.</p>
        <?php endif; ?>
    </div>
</body>
</html>
