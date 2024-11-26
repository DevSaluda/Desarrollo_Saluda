<?php
include_once "db_connection.php";
include_once "Consultas.php";

$codigo = $_POST['codigoEscaneado'];
$usuario = $row['Nombre_Apellidos'];
$sucursalbusqueda = $row['Fk_Sucursal'];

// Verificar si el producto ya fue inventariado por este usuario en esta sucursal
$sqlVerifica = "SELECT * FROM Inventarios_Procesados 
                WHERE Cod_Barra = ? AND Fk_Sucursal = ? AND ProcesadoPor = ?";
$stmtVerifica = $conn->prepare($sqlVerifica);
$stmtVerifica->bind_param("sss", $codigo, $sucursalbusqueda, $usuario);
$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows > 0) {
    // Producto ya procesado por este usuario, actualizar la cantidad
    $row = $resultVerifica->fetch_assoc();
    $cantidadActual = $row['Cantidad'];
    $nuevaCantidad = $cantidadActual + 1; // Incrementar en 1

    $sqlUpdate = "UPDATE Inventarios_Procesados 
                  SET Cantidad = ?, Fecha_Inventario = NOW()
                  WHERE ID_Registro = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ii", $nuevaCantidad, $row['ID_Registro']);
    $stmtUpdate->execute();

    // Responder con los datos actualizados
    $data = array(
        "status" => "continue",
        "producto" => array(
            "id" => $row['ID_Registro'],
            "codigo" => $row["Cod_Barra"],
            "descripcion" => $row["Nombre_Prod"],
            "cantidad" => $nuevaCantidad, // Enviar la nueva cantidad
            "existencia" => $row["Cantidad"], // Existencia previa, si aplica
            "precio" => $row["Precio_Venta"]
        )
    );
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Buscar el producto en Stock_POS si no fue procesado previamente
$sql = "SELECT Cod_Barra, Fk_sucursal, ID_Prod_POS, Nombre_Prod, Precio_Venta, Lote, Existencias_R
        FROM Stock_POS
        WHERE Cod_Barra = ? AND Fk_sucursal = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigo, $sucursalbusqueda);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Producto encontrado, insertar como nuevo en Inventarios_Procesados
    $row = $result->fetch_assoc();

    $sqlInserta = "INSERT INTO Inventarios_Procesados (Cod_Barra, Fk_Sucursal, Cantidad, Fecha_Inventario, ProcesadoPor)
                   VALUES (?, ?, ?, NOW(), ?)";
    $stmtInserta = $conn->prepare($sqlInserta);
    $cantidadInicial = 1;
    $stmtInserta->bind_param("ssis", $codigo, $sucursalbusqueda, $cantidadInicial, $usuario);
    $stmtInserta->execute();

    $data = array(
        "status" => "success",
        "producto" => array(
            "id" => $stmtInserta->insert_id,
            "codigo" => $row["Cod_Barra"],
            "descripcion" => $row["Nombre_Prod"],
            "cantidad" => $cantidadInicial,
            "existencia" => $row["Existencias_R"],
            "precio" => $row["Precio_Venta"],
            "lote" => $row["Lote"]
        )
    );

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Producto no encontrado en Stock_POS
    $data = array("status" => "alert", "message" => "El producto no está asignado en esta sucursal.");
    header('Content-Type: application/json');
    echo json_encode($data);
}

$stmtVerifica->close();
$stmt->close();
if (isset($stmtInserta)) $stmtInserta->close();
if (isset($stmtUpdate)) $stmtUpdate->close();
$conn->close();
?>
