<?php
// get_product.php
include_once "db_connection.php";
include_once "Consultas.php";

// Recibir el código de barras enviado por AJAX
$codigo = $_POST['codigoEscaneado'];

// Obtener los datos generales del producto desde Stock_POS
$sqlProducto = "SELECT Folio_Prod_Stock, ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, Lote
                FROM Stock_POS 
                WHERE Cod_Barra = ? 
                LIMIT 1;";
$stmtProd = $conn->prepare($sqlProducto);
$stmtProd->bind_param("s", $codigo);
$stmtProd->execute();
$resultProd = $stmtProd->get_result();

if ($resultProd->num_rows > 0) {
    $rowProd = $resultProd->fetch_assoc();
    $producto_id = $rowProd['Folio_Prod_Stock'];
    
    // Obtener los lotes disponibles desde Lotes_Productos
    $sucursal_id = $_POST['Fk_Sucursal'] ?? 1; // Obtener dinámicamente desde el frontend o sesión
    $sqlLotes = "SELECT id, lote, fecha_caducidad, cantidad 
                 FROM Lotes_Productos 
                 WHERE producto_id = ? AND sucursal_id = ? AND estatus = 'Disponible'";
    $stmtLotes = $conn->prepare($sqlLotes);
    $stmtLotes->bind_param("ii", $producto_id, $sucursal_id);
    $stmtLotes->execute();
    $resultLotes = $stmtLotes->get_result();
    
    $lotes = [];
    while ($lote = $resultLotes->fetch_assoc()) {
        // Filtrar lotes vacíos y fechas de caducidad inválidas
        if (!empty($lote['lote'])) {
            // Validar la fecha de caducidad
            if (!empty($lote['fecha_caducidad']) && $lote['fecha_caducidad'] != '0000-00-00') {
              
            } else {
                unset($lote['fecha_caducidad']); // Eliminar la fecha si no es válida
            }
            $lotes[] = $lote;
        }
    }
    
    // Si no hay lotes en Lotes_Productos, usar el lote de Stock_POS
    if (empty($lotes) && !empty($rowProd['Lote'])) {
        $lote = [
            'id' => null,
            'lote' => $rowProd['Lote'],
            'cantidad' => 1
        ];
        // Solo agregar fecha de caducidad si está presente y es válida
        if (!empty($rowProd['fecha_caducidad']) && $rowProd['fecha_caducidad'] != '0000-00-00') {
            $lote['fecha_caducidad'] = $rowProd['fecha_caducidad'];
        }
        $lotes[] = $lote;
    }
    
    // Armar el array de respuesta
    $data = [
        "id"           => $producto_id,
        "codigo"       => $rowProd["Cod_Barra"],
        "descripcion"  => $rowProd["Nombre_Prod"],
        "cantidad"     => 1,
        "precio"       => $rowProd["Precio_Venta"],
        "preciocompra" => $rowProd["Precio_C"],
        "lotes"        => $lotes
    ];
    
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Producto no encontrado
    header('Content-Type: application/json');
    echo json_encode([]);
}

$stmtProd->close();
if (isset($stmtLotes)) { $stmtLotes->close(); }
$conn->close();
?>