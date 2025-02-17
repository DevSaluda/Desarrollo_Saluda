<?php
// get_product.php
include_once "db_connection.php";
include_once "Consultas.php";

header('Content-Type: application/json'); // Mover headers al inicio

try {
    // Validar entrada
    if (!isset($_POST['codigoEscaneado'])) {
        throw new Exception('Código no recibido');
    }
    
    $codigo = trim($_POST['codigoEscaneado']);
    if (empty($codigo)) {
        throw new Exception('Código vacío');
    }

    // Obtener datos básicos del producto
    $sqlProducto = "SELECT Folio_Prod_Stock AS id, 
                    Cod_Barra AS codigo, 
                    Nombre_Prod AS descripcion,
                    Precio_Venta AS precio,
                    Precio_C AS preciocompra,
                    Lote,
                    Existencias_R
                    FROM Stock_POS 
                    WHERE Cod_Barra = ? 
                    LIMIT 1";
    
    $stmtProd = $conn->prepare($sqlProducto);
    $stmtProd->bind_param("s", $codigo);
    $stmtProd->execute();
    $resultProd = $stmtProd->get_result();

    if ($resultProd->num_rows === 0) {
        echo json_encode(['error' => 'Producto no encontrado']);
        exit;
    }

    $rowProd = $resultProd->fetch_assoc();
    $response = [
        "id" => $rowProd['id'],
        "codigo" => $rowProd['codigo'],
        "descripcion" => $rowProd['descripcion'],
        "precio" => $rowProd['precio'],
        "preciocompra" => $rowProd['preciocompra'],
        "lotes" => []
    ];

    // Obtener lotes
    $sqlLotes = "SELECT lote, 
                DATE_FORMAT(fecha_caducidad, '%Y-%m-%d') AS fecha_caducidad, 
                cantidad 
                FROM Lotes_Productos 
                WHERE producto_id = ? 
                AND sucursal_id = ? 
                AND cantidad > 0 
                AND estatus = 'Disponible'";
    
    $stmtLotes = $conn->prepare($sqlLotes);
    $sucursal_id = 1; // Obtener dinámicamente según sesión
    $stmtLotes->bind_param("ii", $rowProd['id'], $sucursal_id);
    $stmtLotes->execute();
    $resultLotes = $stmtLotes->get_result();

    // Si hay lotes registrados
    if ($resultLotes->num_rows > 0) {
        while ($lote = $resultLotes->fetch_assoc()) {
            $response['lotes'][] = [
                "lote" => $lote['lote'],
                "fecha_caducidad" => $lote['fecha_caducidad'],
                "cantidad" => (int)$lote['cantidad']
            ];
        }
    } else {
        // Si no hay lotes, usar datos generales del producto
        if (!empty($rowProd['Lote'])) {
            $response['lotes'][] = [
                "lote" => $rowProd['Lote'],
                "fecha_caducidad" => 'N/A',
                "cantidad" => (int)$rowProd['Existencias_R']
            ];
        }
    }

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Cerrar conexiones
    if (isset($stmtProd)) $stmtProd->close();
    if (isset($stmtLotes)) $stmtLotes->close();
    $conn->close();
}
?>