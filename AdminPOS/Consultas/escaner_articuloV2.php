<?php
include_once "db_connection.php";
include_once "Consultas.php";
require __DIR__ . '/../vendor/autoload.php'; // Incluye la librería de Pusher

$codigo = $_POST['codigoEscaneado'];
$usuario = $row['Nombre_Apellidos']; 
$sucursalbusqueda = $row['Fk_Sucursal'];

// Verificar si el producto ya fue inventariado por otro usuario
$sqlVerifica = "SELECT ProcesadoPor FROM Inventarios_Procesados 
                WHERE Cod_Barra = ? AND Fk_Sucursal = ?";
$stmtVerifica = $conn->prepare($sqlVerifica);
$stmtVerifica->bind_param("ss", $codigo, $sucursalbusqueda);
$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows > 0) {
    $rowVerifica = $resultVerifica->fetch_assoc();
    if ($rowVerifica['ProcesadoPor'] !== $usuario) {
        // Si ya fue procesado por otro usuario
        $data = array(
            "status" => "alert",
            "message" => "El producto ya fue inventariado por otro usuario: " . $rowVerifica['ProcesadoPor']
        );
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } else {
        // Si ya fue procesado por el mismo usuario
        $data = array("status" => "continue");
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

// Buscar el producto en Stock_POS
$sql = "SELECT Cod_Barra, Fk_sucursal, GROUP_CONCAT(ID_Prod_POS) AS IDs, 
               GROUP_CONCAT(Nombre_Prod) AS descripciones, 
               GROUP_CONCAT(Precio_Venta) AS precios, 
               GROUP_CONCAT(Lote) AS lotes,
               GROUP_CONCAT(Clave_adicional) AS claves, 
               GROUP_CONCAT(Tipo_Servicio) AS tipos, 
               GROUP_CONCAT(Existencias_R) AS stockactual,
               GROUP_CONCAT(Precio_C) AS precioscompra
        FROM Stock_POS
        WHERE Cod_Barra = ? AND Fk_sucursal = ?
        GROUP BY Cod_Barra";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigo, $sucursalbusqueda);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Producto encontrado
    $row = $result->fetch_assoc();
    $data = array(
        "status" => "success",
        "producto" => array(
            "id" => explode(',', $row['IDs'])[0],
            "codigo" => $row["Cod_Barra"],
            "descripcion" => explode(',', $row['descripciones'])[0],
            "cantidad" => 1,
            "existencia" => explode(',', $row['stockactual'])[0],
            "precio" => explode(',', $row['precios'])[0],
            "preciocompra" => explode(',', $row['precioscompra'])[0],
            "lote" => explode(',', $row['lotes'])[0],
            "clave" => explode(',', $row['claves'])[0],
            "tipo" => explode(',', $row['tipos'])[0]
        )
    );

    // Insertar en Inventarios_Procesados
    $sqlInserta = "INSERT INTO Inventarios_Procesados (Cod_Barra, Fk_Sucursal, Cantidad, Fecha_Inventario, ProcesadoPor)
                   VALUES (?, ?, ?, NOW(), ?)";
    $stmtInserta = $conn->prepare($sqlInserta);
    $stmtInserta->bind_param("ssis", $codigo, $sucursalbusqueda, $data['producto']['cantidad'], $usuario);
    $stmtInserta->execute();

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Producto no encontrado
    $data = array("status" => "alert", "message" => "El producto no está asignado en esta sucursal.");
    header('Content-Type: application/json');
    echo json_encode($data);
}

$stmtVerifica->close();
$stmt->close();
if (isset($stmtInserta)) $stmtInserta->close();
$conn->close();
?>
