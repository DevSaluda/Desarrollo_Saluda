<?php
include_once "db_connection.php";
// Verificar si se recibieron los datos esperados
if (isset($_POST['codigo']) && isset($_POST['sucursal'])) {
    // Recibir los datos del formulario
    $codigo = $_POST['codigo'];
    $sucursal = $_POST['sucursal'];
    $licencia = "Saluda";
    // Obtener la fecha actual para FechaInventario
    $fechaInventario = date("Y-m-d"); // Formato: AAAA-MM-DD

    // Preparar la consulta SQL para insertar los datos en tu tabla
    $sql = "INSERT INTO CodigosSinResultadosEnStockInventario (Cod_Barra, Fk_sucursal, FechaInventario,ID_HO_D) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $codigo, $sucursal, $fechaInventario, $licencia);

    // Ejecutar la consulta
    if ($stmt->execute() === TRUE) {
        // La inserción fue exitosa
        $response = array('success' => true, 'message' => 'Datos insertados correctamente.');
        echo json_encode($response);
    } else {
        // Hubo un error al ejecutar la consulta
        $response = array('success' => false, 'message' => 'Error al insertar los datos: ' . $conn->error);
        echo json_encode($response);
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron los datos esperados, retornar un mensaje de error
    $response = array('success' => false, 'message' => 'No se recibieron los datos esperados.');
    echo json_encode($response);
}
?>
