<?php
include_once "db_connection.php";
include_once "Consultas.php";

$codigo = $_POST['codigoEscaneado'];
$usuario = $row['Nombre_Apellidos']; 
$sucursalbusqueda = $row['Fk_Sucursal'];

// Verificar si el producto ya fue inventariado
$sqlVerifica = "SELECT * FROM Inventarios_Procesados 
                WHERE Cod_Barra = ? AND Fk_Sucursal = ? AND ProcesadoPor = ?";
$stmtVerifica = $conn->prepare($sqlVerifica);
$stmtVerifica->bind_param("sss", $codigo, $sucursalbusqueda, $usuario);
$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows > 0) {
    // Si ya fue procesado por el mismo usuario, devolver estado "continue"
    $row = $resultVerifica->fetch_assoc();
    $data = array(
        "status" => "continue",
        "producto" => array(
            "id" => $row['ID_Registro'],
            "codigo" => $row["Cod_Barra"],
            "descripcion" => $row["Nombre_Prod"],
            "cantidad" => 1, // Incremento por defecto
            "existencia" => $row["Cantidad"],
            "precio" => $row["Precio_Venta"]
        )
    );
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Buscar el producto en Stock_POS
$sql = "SELECT Cod_Barra, Fk_sucursal, ID_Prod_POS, Nombre_Prod, Precio_Venta, Lote, Existencias_R
        FROM Stock_POS
        WHERE Cod_Barra = ? AND Fk_sucursal = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigo, $sucursalbusqueda);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Producto encontrado, devolver estado "success"
    $row = $result->fetch_assoc();
    $data = array(
        "status" => "success",
        "producto" => array(
            "id" => $row['ID_Prod_POS'],
            "codigo" => $row["Cod_Barra"],
            "descripcion" => $row["Nombre_Prod"],
            "cantidad" => 1,
            "existencia" => $row["Existencias_R"],
            "precio" => $row["Precio_Venta"],
            "lote" => $row["Lote"]
        )
    );

    // Insertar el producto en Inventarios_Procesados
    $sqlInserta = "INSERT INTO Inventarios_Procesados (Cod_Barra, Fk_Sucursal, Cantidad, Fecha_Inventario, ProcesadoPor)
                   VALUES (?, ?, ?, NOW(), ?)";
    $stmtInserta = $conn->prepare($sqlInserta);
    $stmtInserta->bind_param("ssis", $codigo, $sucursalbusqueda, $data['producto']['cantidad'], $usuario);
    $stmtInserta->execute();

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Producto no encontrado, devolver estado "alert"
    $data = array("status" => "alert", "message" => "El producto no está asignado en esta sucursal.");
    header('Content-Type: application/json');
    echo json_encode($data);
}

$stmtVerifica->close();
$stmt->close();
if (isset($stmtInserta)) $stmtInserta->close();
$conn->close();
?>
