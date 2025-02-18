<?php
// get_product.php
include_once "db_connection.php";
include_once "Consultas.php";

// Recibir el código de barras enviado por AJAX
$codigo = $_POST['codigoEscaneado'] ?? '';

if (empty($codigo)) {
    echo json_encode(["error" => "Código de barras vacío"]);
    exit;
}

// Mostrar el código recibido
var_dump("Código recibido:", $codigo);
error_log("Código recibido: $codigo");

// Obtener los datos generales del producto desde Stock_POS
$sqlProducto = "SELECT Folio_Prod_Stock, ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, Lote, Fecha_Caducidad, Fk_Sucursal
                FROM Stock_POS 
                WHERE Cod_Barra = ? 
                LIMIT 1;";

// Mostrar la consulta generada
var_dump("Consulta producto:", $sqlProducto);
error_log("Consulta producto: $sqlProducto");

// Preparar y ejecutar la consulta
$stmtProd = $conn->prepare($sqlProducto);
$stmtProd->bind_param("s", $codigo);
$stmtProd->execute();
$resultProd = $stmtProd->get_result();

if ($resultProd->num_rows > 0) {
    $rowProd = $resultProd->fetch_assoc();
    $producto_id = $rowProd['Folio_Prod_Stock'];
    
    // Verificar el valor de $producto_id
    var_dump("Producto ID:", $producto_id);
    error_log("Producto ID: $producto_id");

    // Obtener el sucursal_id correctamente desde el resultado
    $sucursal_id = $rowProd['Fk_Sucursal'];  // Usar Fk_Sucursal de la fila actual

    // Obtener los lotes disponibles desde Lotes_Productos
    $sqlLotes = "SELECT id, lote, fecha_caducidad, cantidad 
                 FROM Lotes_Productos 
                 WHERE producto_id = ? AND sucursal_id = ? AND estatus = 'Disponible'";

    // Mostrar la consulta de lotes
    var_dump("Consulta lotes:", $sqlLotes);
    error_log("Consulta lotes: $sqlLotes");

    $stmtLotes = $conn->prepare($sqlLotes);
    $stmtLotes->bind_param("ii", $producto_id, $sucursal_id);
    $stmtLotes->execute();
    $resultLotes = $stmtLotes->get_result();

    // Verificar si la consulta de lotes devuelve resultados
    if ($resultLotes) {
        var_dump("Resultado de lotes:", $resultLotes);
        error_log("Resultado de lotes: " . json_encode($resultLotes->fetch_all(MYSQLI_ASSOC)));
    } else {
        error_log("Error al ejecutar la consulta de lotes: " . $stmtLotes->error);
    }
    
    $lotes = [];
    while ($lote = $resultLotes->fetch_assoc()) {
        if (!empty($lote['lote'])) { // Filtrar lotes vacíos
            $lotes[] = $lote;
        }
    }

    // Mostrar los lotes obtenidos
    var_dump("Lotes obtenidos:", $lotes);
    error_log("Lotes obtenidos: " . json_encode($lotes));

    // Si no hay lotes en Lotes_Productos, usar el lote y fecha de caducidad de Stock_POS
    if (empty($lotes) && !empty($rowProd['Lote'])) {
        $lotes[] = [
            'id' => null,
            'lote' => $rowProd['Lote'],
            'fecha_caducidad' => $rowProd['Fecha_Caducidad'] ?: '0000-00-00',
            'cantidad' => 1
        ];
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
    var_dump("Producto no encontrado para el código:", $codigo);
    error_log("Producto no encontrado para el código: $codigo");
    header('Content-Type: application/json');
    echo json_encode([]);
}

$stmtProd->close();
if (isset($stmtLotes)) { $stmtLotes->close(); }
$conn->close();
?>
