<?php
include_once "db_connection.php";
include_once "Consultas.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'] ?? '';

    if (empty($codigo)) {
        echo json_encode(['status' => 'error', 'message' => 'El código es obligatorio.']);
        exit;
    }

    // Verificar si el producto ya existe en la tabla de inventarios procesados
    $sqlVerifica = "SELECT * FROM Inventarios_Procesados WHERE Cod_Barra = ?";
    $stmtVerifica = $conn->prepare($sqlVerifica);
    $stmtVerifica->bind_param("s", $codigo);
    $stmtVerifica->execute();
    $resultVerifica = $stmtVerifica->get_result();

    if ($resultVerifica->num_rows > 0) {
        // Si existe, actualizar la cantidad
        $row = $resultVerifica->fetch_assoc();
        $cantidadActual = $row['Cantidad'];
        $nuevaCantidad = $cantidadActual + 1;

        $sqlUpdate = "UPDATE Inventarios_Procesados 
                      SET Cantidad = ?, Fecha_Inventario = NOW()
                      WHERE ID_Registro = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $nuevaCantidad, $row['ID_Registro']);
        $stmtUpdate->execute();

        // Enviar respuesta con los datos actualizados
        echo json_encode([
            'status' => 'continue',
            'producto' => [
                'id' => $row['ID_Registro'],
                'codigo' => $row['Cod_Barra'],
                'descripcion' => $row['Nombre_Prod'],
                'cantidad' => $nuevaCantidad,
                'existencia' => $row['Stock'],
                'precio' => $row['Precio_Venta']
            ]
        ]);
    } else {
        // Si no existe, agregar un nuevo registro
        $sqlProducto = "SELECT * FROM Productos WHERE Cod_Barra = ?";
        $stmtProducto = $conn->prepare($sqlProducto);
        $stmtProducto->bind_param("s", $codigo);
        $stmtProducto->execute();
        $resultProducto = $stmtProducto->get_result();

        if ($resultProducto->num_rows > 0) {
            $producto = $resultProducto->fetch_assoc();

            $sqlInsert = "INSERT INTO Inventarios_Procesados (Cod_Barra, Nombre_Prod, Cantidad, Stock, Precio_Venta, Fecha_Inventario) 
                          VALUES (?, ?, ?, ?, ?, NOW())";
            $stmtInsert = $conn->prepare($sqlInsert);
            $cantidadInicial = 1;
            $stmtInsert->bind_param(
                "ssiid",
                $producto['Cod_Barra'],
                $producto['Nombre_Prod'],
                $cantidadInicial,
                $producto['Stock'],
                $producto['Precio_Venta']
            );
            $stmtInsert->execute();

            echo json_encode([
                'status' => 'success',
                'producto' => [
                    'id' => $conn->insert_id,
                    'codigo' => $producto['Cod_Barra'],
                    'descripcion' => $producto['Nombre_Prod'],
                    'cantidad' => $cantidadInicial,
                    'existencia' => $producto['Stock'],
                    'precio' => $producto['Precio_Venta']
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado.']);
        }
    }
}
?>
