<?php
include_once "db_connection.php";
include_once "Consultas.php";
require __DIR__ . '/../vendor/autoload.php'; // Incluye la librería de Pusher

// Obtener el código de barras y la sucursal enviados por AJAX
$codigo = $_POST['codigoEscaneado'];
$sucursalbusqueda = $row['Fk_Sucursal'];

// Verificar si el producto ya fue inventariado
$sqlVerifica = "SELECT * FROM Inventarios_Procesados 
                WHERE Cod_Barra = ? AND Fk_Sucursal = ?";
$stmtVerifica = $conn->prepare($sqlVerifica);
$stmtVerifica->bind_param("ss", $codigo, $sucursalbusqueda);
$stmtVerifica->execute();
$resultVerifica = $stmtVerifica->get_result();

if ($resultVerifica->num_rows > 0) {
    // Si el producto ya está inventariado, se detiene el proceso
    $data = array("status" => "error", "message" => "El producto ya está inventariado.");
    header('Content-Type: application/json');
    echo json_encode($data);
    exit; // Salir del script para evitar procesamiento adicional
}

// Si no existe, proceder con el registro en el inventario
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
    // Si se encuentra el producto, se obtiene y se procesa
    $row = $result->fetch_assoc();
    $ids = explode(',', $row['IDs']);
    $descripciones = explode(',', $row['descripciones']);
    $precios = explode(',', $row['precios']);
    $precioscompra = explode(',', $row['precioscompra']);
    $stockactual = explode(',', $row['stockactual']);
    $lotes = explode(',', $row['lotes']);
    $claves = explode(',', $row['claves']);
    $tipos = explode(',', $row['tipos']);

    $data = array(
        "id" => $ids[0],
        "codigo" => $row["Cod_Barra"],
        "descripcion" => $descripciones[0],
        "cantidad" => [1],
        "existencia" => $stockactual[0],
        "precio" => $precios[0],
        "preciocompra" => $precioscompra[0],
        "lote" => $lotes[0],
        "clave" => $claves[0],
        "tipo" => $tipos[0],
        "eliminar" => ""
    );

    $options = array(
        'cluster' => 'us2',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'effad4fdf8949f07766a',
        '9a9bc81f5d2fbc13618c',
        '1896713',
        $options
    );

    $data['message'] = "Producto escaneado: $codigo";
    $pusher->trigger('my-channel', 'my-event', $data);

    // Guardar el producto en Inventarios_Procesados
    $sqlInserta = "INSERT INTO Inventarios_Procesados (Cod_Barra, Fk_Sucursal, Cantidad, Fecha_Inventario, ProcesadoPor)
                   VALUES (?, ?, ?, NOW(), ?)";
    $stmtInserta = $conn->prepare($sqlInserta);
    $cantidad = 1;
    $usuario = 'Admin'; // Cambiar según el sistema de autenticación
    $stmtInserta->bind_param("ssis", $codigo, $sucursalbusqueda, $cantidad, $usuario);
    $stmtInserta->execute();

    // Respuesta exitosa
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Si no se encuentra el producto en Stock_POS
    $data = array("status" => "error", "message" => "Producto no encontrado.");
    header('Content-Type: application/json');
    echo json_encode($data);
}

// Cerrar las conexiones
$stmtVerifica->close();
$stmt->close();
$conn->close();

?>
