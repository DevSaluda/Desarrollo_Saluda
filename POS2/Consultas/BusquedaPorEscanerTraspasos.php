<?php
// get_product.php
include_once "db_connection.php";  // Asegúrate de tener la conexión correcta
include_once "Consultas.php";

// Recibir el código de barras enviado por AJAX
$codigo = $_POST['codigoEscaneado'];

// Primero, obtenemos los datos generales del producto desde Stock_POS
$sqlProducto = "SELECT Folio_Prod_Stock,ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C 
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
    
    // Obtener los lotes disponibles desde Lotes_Productos para este producto
    // Puedes modificar la variable $sucursal_id o incluir otros filtros (como el estatus)
    $sucursal_id = 1; // Ejemplo: valor fijo, pero lo puedes obtener dinámicamente
    $sqlLotes = "SELECT id, lote, fecha_caducidad, cantidad 
                 FROM Lotes_Productos 
                 WHERE producto_id = ? AND sucursal_id = ? AND estatus = 'Disponible'";
    $stmtLotes = $conn->prepare($sqlLotes);
    $stmtLotes->bind_param("ii", $producto_id, $sucursal_id);
    $stmtLotes->execute();
    $resultLotes = $stmtLotes->get_result();
    
    $lotes = array();
    while ($lote = $resultLotes->fetch_assoc()) {
        $lotes[] = $lote;
    }
    
    // Armar el array de respuesta
    $data = array(
        "id"           => $producto_id,
        "codigo"       => $rowProd["Cod_Barra"],
        "descripcion"  => $rowProd["Nombre_Prod"],
        "cantidad"     => 1,  // Cantidad inicial sugerida
        "precio"       => $rowProd["Precio_Venta"],
        "preciocompra" => $rowProd["Precio_C"],
        "lotes"        => $lotes
    );
    
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Producto no encontrado
    header('Content-Type: application/json');
    echo json_encode(array());
}

$stmtProd->close();
if (isset($stmtLotes)) { $stmtLotes->close(); }
$conn->close();
?>
